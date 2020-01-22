<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset(Storage::url('logo/logo-full.png'))); ?>" alt="<?php echo e(env('APP_NAME')); ?>" height="35">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" alt="<?php echo e(env('APP_NAME')); ?>" height="25"></a>
    </div>
    <ul class="sidebar-menu">
        <li class="<?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == NULL) ? ' active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('home')); ?>">
                <i class="dripicons-home"></i> <span> <?php echo e(__('Dashboard')); ?> </span>
            </a>
        </li>
        <?php if(isset($currantWorkspace) && $currantWorkspace): ?>
            <li class="<?php echo e((Request::route()->getName() == 'projects.index') ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('projects.index',$currantWorkspace->slug)); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.projects.index',$currantWorkspace->slug)); ?><?php endif; ?>">
                    <i class="dripicons-briefcase"></i>
                    <span> <?php echo e(__('Projects')); ?> </span>
                </a>
            </li>
            <?php if(auth()->guard('web')->check()): ?>
                <li class="<?php echo e((Request::route()->getName() == 'users.index') ? ' active' : ''); ?>">
                    <a href="<?php echo e(route('users.index',$currantWorkspace->slug)); ?>">
                        <i class="dripicons-network-3"></i>
                        <span> <?php echo e(__('Users')); ?> </span>
                    </a>
                </li>
                <?php if($currantWorkspace->creater->id == Auth::user()->id): ?>
                    <li class="<?php echo e((Request::route()->getName() == 'clients.index') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('clients.index',$currantWorkspace->slug)); ?>">
                            <i class="dripicons-user"></i>
                            <span> <?php echo e(__('Clients')); ?> </span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="<?php echo e((Request::route()->getName() == 'calender.index') ? ' active' : ''); ?>">
                    <a href="<?php echo e(route('calender.index',$currantWorkspace->slug)); ?>">
                        <i class="dripicons-calendar"></i>
                        <span> <?php echo e(__('Calender')); ?> </span>
                    </a>
                </li>

                <li class="<?php echo e((Request::route()->getName() == 'notes.index') ? ' active' : ''); ?>">
                    <a href="<?php echo e(route('notes.index',$currantWorkspace->slug)); ?>">
                        <i class="dripicons-clipboard"></i>
                        <span> <?php echo e(__('Notes')); ?> </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(Auth::user()->type == 'admin'): ?>
            <li class="<?php echo e((Request::route()->getName() == 'users.index') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('users.index','')); ?>">
                    <i class="dripicons-user-group"></i>
                    <span> <?php echo e(__('Users')); ?> </span>
                </a>
            </li>
        <?php endif; ?>
        <?php if(Auth::user()->type == 'admin' || $currantWorkspace->creater->id == Auth::user()->id): ?>
            <li class="<?php echo e((Request::route()->getName() == 'plans.index') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('plans.index')); ?>">
                    <i class="dripicons-trophy"></i>
                    <span> <?php echo e(__('Plans')); ?> </span>
                </a>
            </li>
            <li class="<?php echo e((Request::route()->getName() == 'order.index') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('order.index')); ?>">
                    <i class="dripicons-card"></i>
                    <span> <?php echo e(__('Orders')); ?> </span>
                </a>
            </li>
        <?php endif; ?>

        <?php if(Auth::user()->type == 'admin'): ?>
            <li class="<?php echo e((Request::route()->getName() == 'settings.index') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('settings.index')); ?>">
                    <i class="dripicons-gear"></i>
                    <span> <?php echo e(__('Settings')); ?> </span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</aside>
<?php /**PATH /var/www/html/Taskly2/site2/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>