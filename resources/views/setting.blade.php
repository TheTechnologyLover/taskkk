@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center mt-5 mb-1">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('settings.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="border p-3 mb-3 rounded">
                                <h4 class="header-title mb-3">{{__('Site Settings')}}</h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo">{{ __('Small Logo') }}</label>
                                            <input type="file" name="logo" id="logo" class="form-control" accept="image/png"/>
                                            @if ($errors->has('logo'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('logo') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img src="{{asset(Storage::url('logo/logo.png'))}}" style="max-width: 100%"/>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="full_logo">{{ __('Logo') }}</label>
                                            <input type="file" name="full_logo" id="full_logo" class="form-control" accept="image/png"/>
                                            @if ($errors->has('full_logo'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('full_logo') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img src="{{asset(Storage::url('logo/logo-full.png'))}}" style="max-width: 100%"/>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 mb-3 rounded">
                                <h4 class="header-title mb-3">{{__('Mailer Settings')}}</h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label') }}</label>
                                            <input type="text" name="mail_driver" id="mail_driver" class="form-control" value="{{env('MAIL_DRIVER')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}"/>
                                            @if ($errors->has('mail_driver'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('mail_driver') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_host">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label') }}</label>
                                            <input type="text" name="mail_host" id="mail_host" class="form-control" value="{{env('MAIL_HOST')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}"/>
                                            @if ($errors->has('mail_host'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('mail_host') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label') }}</label>
                                            <input type="number" name="mail_port" id="mail_port" class="form-control" value="{{env('MAIL_PORT')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}"/>
                                            @if ($errors->has('mail_port'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('mail_port') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_username">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label') }}</label>
                                            <input type="text" name="mail_username" id="mail_username" class="form-control" value="{{env('MAIL_USERNAME')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}"/>
                                            @if ($errors->has('mail_username'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('mail_username') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label') }}</label>
                                            <input type="text" name="mail_password" id="mail_password" class="form-control" value="{{env('MAIL_PASSWORD')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}"/>
                                            @if ($errors->has('mail_password'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('mail_password') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_encryption">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label') }}</label>
                                            <input type="text" name="mail_encryption" id="mail_encryption" class="form-control" value="{{env('MAIL_ENCRYPTION')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}"/>
                                            @if ($errors->has('mail_encryption'))
                                                <span class="invalid-feedback d-block">
                                                {{ $errors->first('mail_encryption') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="#" class="btn btn-primary text-white" data-ajax-popup="true" data-title="{{__('Send Test Mail')}}" data-url="{{route('test.email')}}">
                                            {{__('Send Test Mail')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 mb-3 rounded">
                                <h4 class="header-title mb-3">{{__('Stripe Settings')}}</h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stripe_key">{{ __('Stripe Key') }}</label>
                                            <input type="text" name="stripe_key" id="stripe_key" class="form-control" value="{{env('STRIPE_KEY')}}" placeholder="{{ __('Stripe Key') }}"/>
                                            @if ($errors->has('stripe_key'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('stripe_key') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stripe_secret">{{ __('Stripe Secret') }}</label>
                                            <input type="text" name="stripe_secret" id="stripe_secret" class="form-control" value="{{env('STRIPE_SECRET')}}" placeholder="{{ __('Stripe Secret') }}"/>
                                            @if ($errors->has('stripe_secret'))
                                                <span class="invalid-feedback d-block">
                                                    {{ $errors->first('stripe_secret') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end Credit/Debit Card box-->
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="text-sm-right">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="mdi mdi-content-save mr-1"></i> {{__('Save')}}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
