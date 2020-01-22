<?php

namespace App\Http\Controllers;

use App\Mail\EmailTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\DocBlock\Description;

class SettingsController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        if($user->type == 'admin')
        {
            return view('setting');
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        if($user->type == 'admin')
        {
            if($request->logo)
            {
                $request->validate(['logo' => 'required|image|mimes:png|max:1024']);
                $logoName = 'logo.png';
                $request->logo->storeAs('logo', $logoName);
            }
            if($request->full_logo)
            {
                $request->validate(['full_logo' => 'required|image|mimes:png|max:1024']);
                $logoName = 'logo-full.png';
                $request->full_logo->storeAs('logo', $logoName);
            }

            $request->validate(
                [
                    'mail_driver' => 'required|string|max:50',
                    'mail_host' => 'required|string|max:50',
                    'mail_port' => 'required|string|max:50',
                    'mail_username' => 'required|string|max:50',
                    'mail_password' => 'required|string|max:50',
                    'mail_encryption' => 'required|string|max:50',
                    'stripe_key' => 'required|string|max:50',
                    'stripe_secret' => 'required|string|max:50',
                ]
            );
            $path = base_path('.env');

            if(file_exists($path))
            {
                file_put_contents(
                    $path, str_replace(
                             'MAIL_DRIVER=' . ("'" . env('MAIL_DRIVER') . "'"), "MAIL_DRIVER='" . addslashes($request->mail_driver) . "'", file_get_contents($path)
                         )
                );
                file_put_contents(
                    $path, str_replace(
                             'MAIL_HOST=' . ("'" . env('MAIL_HOST') . "'"), "MAIL_HOST='" . addslashes($request->mail_host) . "'", file_get_contents($path)
                         )
                );
                file_put_contents(
                    $path, str_replace(
                             'MAIL_PORT=' . ("'" . env('MAIL_PORT') . "'"), "MAIL_PORT='" . addslashes($request->mail_port) . "'", file_get_contents($path)
                         )
                );
                file_put_contents(
                    $path, str_replace(
                             'MAIL_USERNAME=' . ((env('MAIL_USERNAME') == NULL) ? 'null' : ("'" . env('MAIL_USERNAME')) . "'"), "MAIL_USERNAME='" . addslashes($request->mail_username) . "'", file_get_contents($path)
                         )
                );
                file_put_contents(
                    $path, str_replace(
                             'MAIL_PASSWORD=' . ((env('MAIL_PASSWORD') == NULL) ? 'null' : ("'" . env('MAIL_PASSWORD')) . "'"), "MAIL_PASSWORD='" . addslashes($request->mail_password) . "'", file_get_contents($path)
                         )
                );
                file_put_contents(
                    $path, str_replace(
                             'MAIL_ENCRYPTION=' . ((env('MAIL_ENCRYPTION') == NULL) ? 'null' : ("'" . env('MAIL_ENCRYPTION')) . "'"), "MAIL_ENCRYPTION='" . addslashes($request->mail_encryption) . "'", file_get_contents($path)
                         )
                );
                file_put_contents(
                    $path, str_replace(
                             'STRIPE_KEY=' . ((env('STRIPE_KEY') == NULL) ? 'null' : ("'" . env('STRIPE_KEY')) . "'"), "STRIPE_KEY='" . addslashes($request->stripe_key) . "'", file_get_contents($path)
                         )
                );
                file_put_contents(
                    $path, str_replace(
                             'STRIPE_SECRET=' . ((env('STRIPE_SECRET') == NULL) ? 'null' : ("'" . env('STRIPE_SECRET')) . "'"), "STRIPE_SECRET='" . addslashes($request->stripe_secret) . "'", file_get_contents($path)
                         )
                );
            }

            return redirect()->back()->with('success', __('Setting updated successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function testEmail()
    {
        $user = \Auth::user();

        if($user->type == 'admin')
        {
            return view('users.test_email');
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    public function testEmailSend(Request $request)
    {
        $validator = \Validator::make($request->all(), ['email' => 'required|email']);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        try
        {
            Mail::to($request->email)->send(new EmailTest());
        }
        catch(\Exception $e)
        {
            //            return redirect()->back()->with('error', $e->getMessage());
            return redirect()->back()->with('error', 'Something is Wrong.');
        }

        return redirect()->back()->with('success', __('Email send Successfully'));
    }

}
