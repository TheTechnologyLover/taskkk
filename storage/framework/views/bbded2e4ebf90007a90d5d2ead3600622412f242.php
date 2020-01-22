<?php $__env->startSection('content'); ?>
    <section class="section">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(Auth::user()->type == 'admin'): ?>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h2 class="section-title"><?php echo e(__('Plans')); ?></h2>
                </div>
                <div class="col-sm-8">
                    <div class="text-sm-right">
                        <button type="button" class="btn btn-primary mt-4" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Add Plan')); ?>" data-url="<?php echo e(route('plans.create')); ?>">
                            <i class="mdi mdi-plus"></i> <?php echo e(__('Add Plan')); ?>

                        </button>
                    </div>
                </div>
            </div>
            <?php if(empty(env('STRIPE_KEY')) || empty(env('STRIPE_SECRET'))): ?>
                <div class="alert alert-warning"><i class="dripicons-warning"></i> <?php echo e(__('Please set stripe api key & secret key for add new plan')); ?></div>
            <?php endif; ?>
        <?php else: ?>
            <h2 class="section-title"><?php echo e(__('Plans')); ?></h2>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <?php if(Auth::user()->type != 'admin'): ?>
                    <div class="text-center">
                        <h5 class="mb-2"><?php echo e(__('Our Plans and Pricing')); ?></h5>
                        <p class="text-muted w-50 m-auto">
                            <?php echo e(__('We have plans and prices that fit your business perfectly. Make your client site a success with our products.')); ?>

                        </p>
                    </div>
                <?php endif; ?>

                <div class="row mt-5 mb-1">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="pricing">

                                <?php if(Auth::user()->plan == $plan->id): ?>
                                    <div class="pricing-title">
                                        <?php echo e(__('Current Plan')); ?>

                                    </div>
                                <?php endif; ?>

                                <?php if(Auth::user()->type == 'admin'): ?>
                                    <div class="dropdown card-widgets float-right mt-2 mr-3">
                                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dripicons-gear"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Plan')); ?>" data-url="<?php echo e(route('plans.edit',$plan->id)); ?>"><i class="mdi mdi-pencil mr-1"></i><?php echo e(__('Edit')); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="pricing-padding">
                                    <img <?php if($plan->image): ?> src="<?php echo e(asset('/storage/plans/'.$plan->image)); ?>" <?php else: ?> avatar="<?php echo e($plan->name); ?>" <?php endif; ?> alt="plan image" class="rounded-circle card-pricing-icon">
                                    <div class="pricing-price">
                                        <div>$<?php echo e($plan->price); ?></div>
                                        <div><?php if($plan->duration!='Unlimited'): ?>/<?php endif; ?> <?php echo e(__($plan->duration)); ?></div>
                                        <h5><?php echo e($plan->name); ?></h5>
                                    </div>
                                    <div class="pricing-details">
                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="dripicons-checkmark"></i></div>
                                            <div class="pricing-item-label"><?php echo e(($plan->max_workspaces < 0)?__('Unlimited'):$plan->max_workspaces); ?> <?php echo e(__('Workspaces')); ?></div>
                                        </div>
                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="dripicons-checkmark"></i></div>
                                            <div class="pricing-item-label"><?php echo e(($plan->max_users<0)?__('Unlimited'):$plan->max_users); ?> <?php echo e(__('Users Per Workspace')); ?></div>
                                        </div>
                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="dripicons-checkmark"></i></div>
                                            <div class="pricing-item-label"><?php echo e(($plan->max_clients<0)?__('Unlimited'):$plan->max_clients); ?> <?php echo e(__('Clients Per Workspace')); ?></div>
                                        </div>
                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="dripicons-checkmark"></i></div>
                                            <div class="pricing-item-label"><?php echo e(($plan->max_projects<0)?__('Unlimited'):$plan->max_projects); ?> <?php echo e(__('Projects Per Workspace')); ?></div>
                                        </div>
                                        <?php if($plan->description): ?>
                                            <p>
                                                <?php echo e($plan->description); ?>

                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(Auth::user()->type != 'admin'): ?>
                                    <?php if(Auth::user()->plan != $plan->id): ?>
                                        <div class="pricing-cta">
                                            <a href="<?php echo e(route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"><?php echo e(__('Choose Plan')); ?> <i class="dripicons-arrow-right"></i></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if(($key+1)%3 == 0): ?>
                </div>
                <div class="row mt-4 mb-1">
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>

    </section>
    <!-- container -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\taskly-saas\resources\views/plans/index.blade.php ENDPATH**/ ?>