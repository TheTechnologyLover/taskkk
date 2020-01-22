<form class="pl-3 pr-3" method="post" action="<?php echo e(route('test.email.send')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="email"><?php echo e(__('E-Mail Address')); ?></label>
        <input type="email" class="form-control" id="email" name="email" required/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit"><?php echo e(__('Send Test Mail')); ?></button>
    </div>
</form><?php /**PATH /var/www/html/taskly/saas/site2/resources/views/users/test_email.blade.php ENDPATH**/ ?>