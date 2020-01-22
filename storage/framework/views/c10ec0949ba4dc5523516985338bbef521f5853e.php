<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row justify-content-center mt-5 mb-1">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('settings.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="border p-3 mb-3 rounded">
                                <h4 class="header-title mb-3"><?php echo e(__('Site Settings')); ?></h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo"><?php echo e(__('Small Logo')); ?></label>
                                            <input type="file" name="logo" id="logo" class="form-control" accept="image/png"/>
                                            <?php if($errors->has('logo')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('logo')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" style="max-width: 100%"/>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="full_logo"><?php echo e(__('Logo')); ?></label>
                                            <input type="file" name="full_logo" id="full_logo" class="form-control" accept="image/png"/>
                                            <?php if($errors->has('full_logo')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('full_logo')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img src="<?php echo e(asset(Storage::url('logo/logo-full.png'))); ?>" style="max-width: 100%"/>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 mb-3 rounded">
                                <h4 class="header-title mb-3"><?php echo e(__('Mailer Settings')); ?></h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_driver"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label')); ?></label>
                                            <input type="text" name="mail_driver" id="mail_driver" class="form-control" value="<?php echo e(env('MAIL_DRIVER')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder')); ?>"/>
                                            <?php if($errors->has('mail_driver')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('mail_driver')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_host"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label')); ?></label>
                                            <input type="text" name="mail_host" id="mail_host" class="form-control" value="<?php echo e(env('MAIL_HOST')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder')); ?>"/>
                                            <?php if($errors->has('mail_host')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('mail_host')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_port"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label')); ?></label>
                                            <input type="number" name="mail_port" id="mail_port" class="form-control" value="<?php echo e(env('MAIL_PORT')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder')); ?>"/>
                                            <?php if($errors->has('mail_port')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('mail_port')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_username"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label')); ?></label>
                                            <input type="text" name="mail_username" id="mail_username" class="form-control" value="<?php echo e(env('MAIL_USERNAME')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder')); ?>"/>
                                            <?php if($errors->has('mail_username')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('mail_username')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_password"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label')); ?></label>
                                            <input type="text" name="mail_password" id="mail_password" class="form-control" value="<?php echo e(env('MAIL_PASSWORD')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder')); ?>"/>
                                            <?php if($errors->has('mail_password')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('mail_password')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_encryption"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label')); ?></label>
                                            <input type="text" name="mail_encryption" id="mail_encryption" class="form-control" value="<?php echo e(env('MAIL_ENCRYPTION')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder')); ?>"/>
                                            <?php if($errors->has('mail_encryption')): ?>
                                                <span class="invalid-feedback d-block">
                                                <?php echo e($errors->first('mail_encryption')); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="#" class="btn btn-primary text-white" data-ajax-popup="true" data-title="<?php echo e(__('Send Test Mail')); ?>" data-url="<?php echo e(route('test.email')); ?>">
                                            <?php echo e(__('Send Test Mail')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 mb-3 rounded">
                                <h4 class="header-title mb-3"><?php echo e(__('Stripe Settings')); ?></h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stripe_key"><?php echo e(__('Stripe Key')); ?></label>
                                            <input type="text" name="stripe_key" id="stripe_key" class="form-control" value="<?php echo e(env('STRIPE_KEY')); ?>" placeholder="<?php echo e(__('Stripe Key')); ?>"/>
                                            <?php if($errors->has('stripe_key')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('stripe_key')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stripe_secret"><?php echo e(__('Stripe Secret')); ?></label>
                                            <input type="text" name="stripe_secret" id="stripe_secret" class="form-control" value="<?php echo e(env('STRIPE_SECRET')); ?>" placeholder="<?php echo e(__('Stripe Secret')); ?>"/>
                                            <?php if($errors->has('stripe_secret')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('stripe_secret')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end Credit/Debit Card box-->
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="text-sm-right">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="mdi mdi-content-save mr-1"></i> <?php echo e(__('Save')); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/taskly/saas/site2/resources/views/setting.blade.php ENDPATH**/ ?>