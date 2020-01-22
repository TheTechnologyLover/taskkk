<?php

namespace App\Http\Controllers;

use App\Mail\SendLoginDetail;
use App\Message;
use App\Plan;
use App\Project;
use App\User;
use App\UserProject;
use App\UserWorkspace;
use App\Utility;
use App\Mail\SendWorkspaceInvication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Config;
use Pusher\Pusher;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug = '')
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        if($currantWorkspace)
        {
            $users = User::select('users.*', 'user_workspaces.permission', 'user_workspaces.is_active')->join('user_workspaces', 'user_workspaces.user_id', '=', 'users.id');
            $users->where('user_workspaces.workspace_id', '=', $currantWorkspace->id);
            $users = $users->get();
        }
        else
        {
            $users = User::where('type', '!=', 'admin')->get();
        }

        return view('users.index', compact('currantWorkspace', 'users'));
    }

    public function account()
    {
        $user             = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug('');

        return view('users.account', compact('currantWorkspace', 'user'));
    }

    public function edit($slug, $id)
    {
        $user             = User::find($id);
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);

        return view('users.edit', compact('currantWorkspace', 'user'));
    }

    public function deleteAvatar()
    {
        $objUser         = Auth::user();
        $objUser->avatar = '';
        $objUser->save();

        return redirect()->back()->with('success', 'Avatar deleted successfully');
    }

    public function update($slug = null, $id = null, Request $request)
    {
        if($id)
        {
            $objUser = User::find($id);
        }
        else
        {
            $objUser = Auth::user();
        }
        $validation         = [];
        $validation['name'] = 'required';
        if($request->avatar)
        {
            $validation['avatar'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($validation);

        $post = $request->all();
        if($request->avatar)
        {
            $avatarName = $objUser->id . '_avatar' . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
            $post['avatar'] = $avatarName;
        }

        $objUser->update($post);

        return redirect()->back()->with('success', __('User Updated Successfully!'));
    }

    public function destroy($user_id)
    {
        if($user_id != 1)
        {
            $user = User::find($user_id);
            $user->delete();

            return redirect()->back()->with('success', __('User Deleted Successfully!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Some Thing Is Wrong!'));
        }
    }

    public function updatePassword(Request $request)
    {
        if(Auth::Check())
        {
            $request->validate(
                [
                    'old_password' => 'required',
                    'password' => 'required|same:password',
                    'password_confirmation' => 'required|same:password',
                ]
            );
            $objUser          = Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;

            if(Hash::check($request_data['old_password'], $current_password))
            {

                $objUser->password = Hash::make($request_data['password']);;
                $objUser->save();

                return redirect()->back()->with('success', __('Password Updated Successfully!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Please Enter Correct Current Password!'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Some Thing Is Wrong!'));
        }
    }


    public function getUserJson($workspace_id)
    {
        $return  = [];
        $objdata = UserWorkspace::select('user.email')->join('users', 'users.id', '=', 'user_workspaces.user_id')->where('user_workspaces.is_active', '=', 1)->where('users.id', '!=', auth()->id())->get();
        foreach($objdata as $data)
        {
            $return[] = $data->email;
        }

        return response()->json($return);
    }

    public function getProjectUserJson($projectID)
    {
        $project = Project::find($projectID);
        return $project->users->toJSON();
    }
    public function getProjectMilestoneJson($projectID)
    {
        $project = Project::find($projectID);
        return $project->milestones->toJSON();
    }

    public function invite($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);

        return view('users.invite', compact('currantWorkspace'));
    }

    public function inviteUser($slug, Request $request)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $post             = $request->all();
        $userList         = explode(',', $post['users_list']);
        $userList         = array_filter($userList);
        foreach($userList as $email)
        {
            $registerUsers = User::where('email', $email)->first();
            if(!$registerUsers)
            {
                $objUser = \Auth::user();
                $plan    = Plan::find($objUser->plan);
                if($plan)
                {
                    $totalWS = $objUser->countUsers($currantWorkspace->id);
                    if($totalWS < $plan->max_users || $plan->max_users == -1)
                    {
                        $arrUser                      = [];
                        $arrUser['name']              = __('No Name');
                        $arrUser['email']             = $email;
                        $password                     = Str::random(8);
                        $arrUser['password']          = Hash::make($password);
                        $arrUser['currant_workspace'] = $currantWorkspace->id;
                        $registerUsers                = User::create($arrUser);
                        $assignPlan                   = $registerUsers->assignPlan(1);
                        $registerUsers->password      = $password;
                        if(!$assignPlan['is_success'])
                        {
                            return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                        }

                        try
                        {
                            Mail::to($email)->send(new SendLoginDetail($registerUsers));
                        }
                        catch(\Exception $e)
                        {
                            $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                        }
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('Your user limit is over, Please upgrade plan.'));
                    }
                }
                else
                {
                    return redirect()->back()->with('error', __('Default plan is deleted.'));
                }

            }

            // assign workspace first
            $is_assigned = false;
            foreach($registerUsers->workspace as $workspace)
            {
                if($workspace->id == $currantWorkspace->id)
                {
                    $is_assigned = true;
                }
            }

            if(!$is_assigned)
            {
                UserWorkspace::create(
                    [
                        'user_id' => $registerUsers->id,
                        'workspace_id' => $currantWorkspace->id,
                        'permission' => 'Member',
                    ]
                );

                try
                {
                    Mail::to($registerUsers->email)->send(new SendWorkspaceInvication($registerUsers, $currantWorkspace));
                }
                catch(\Exception $e)
                {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

            }
        }

        return redirect()->route('users.index', $currantWorkspace->slug)->with('success', __('Users Invited Successfully!') . ((isset($smtp_error)) ? ' <br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }

    public function removeUser($slug, $id)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $userWorkspace    = UserWorkspace::where('user_id', '=', $id)->where('workspace_id', '=', $currantWorkspace->id)->first();
        if($userWorkspace)
        {
            $user = User::find($id);
            $userProjectCount = $user->countProject($currantWorkspace->id);
            if($userProjectCount == 0){
                $userWorkspace->delete();
            }else{
                return redirect()->route('users.index', $currantWorkspace->slug)->with('warning', __('Please Remove User From Project!'));
            }

            return redirect()->route('users.index', $currantWorkspace->slug)->with('success', __('User Removed Successfully!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong.'));
        }
    }
}
