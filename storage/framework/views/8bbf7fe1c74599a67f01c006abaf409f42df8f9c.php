<div class="message-wrapper chat-content rounded">
    <?php if(count($messages) > 0): ?>
        <ul class="messages pl-1">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="message clearfix">
                    <div class="<?php echo e(($message->from == Auth::id()) ? 'sent' : 'received'); ?>">
                        <p><?php echo e($message->message); ?></p>
                        <p class="date"><?php echo e(date('d M y, h:i a', strtotime($message->created_at))); ?></p>
                    </div>
                </li>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <h3 class="text-center mt-5 pt-5">No Message Found.!</h3>
    <?php endif; ?>
</div>
<div class="input-text pt-3">
    <input type="text" name="message" class="submit form-control">
</div>
<?php /**PATH /var/www/html/Taskly2/site2/resources/views/chats/message.blade.php ENDPATH**/ ?>