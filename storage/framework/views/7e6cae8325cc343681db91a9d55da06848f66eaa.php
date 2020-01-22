<?php $__env->startSection('content'); ?>

<section class="section">


    <h2 class="section-title"><?php echo e(__('Orders')); ?></h2>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="selection-datatable" class="table" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Order Id')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Plan Name')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Invoice')); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($order->order_id); ?></td>
                                <td><?php echo e($order->user_name); ?></td>
                                <td><?php echo e($order->plan_name); ?></td>
                                <td>$<?php echo e(number_format($order->price)); ?></td>
                                <td>
                                    <?php if($order->payment_status == 'succeeded'): ?>
                                        <i class="mdi mdi-circle text-success"></i> <?php echo e(ucfirst($order->payment_status)); ?>

                                    <?php else: ?>
                                        <i class="mdi mdi-circle text-danger"></i> <?php echo e(ucfirst($order->payment_status)); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                                <td>
                                    <?php if(!empty($order->receipt)): ?>
                                        <a href="<?php echo e($order->receipt); ?>" target="_blank" class="btn btn-outline-primary btn-rounded btn-sm"><i class="mdi mdi-printer mr-1"></i> <?php echo e(__('Invoice')); ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('assets/css/vendor/dataTables.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/vendor/responsive.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/vendor/buttons.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/vendor/select.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/vendor/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vendor/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vendor/dataTables.responsive.min.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $("#selection-datatable").DataTable({
                order: [],
                select: {style: "multi"},
                language: {paginate: {previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>"}},
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Taskly2/site2/resources/views/order/index.blade.php ENDPATH**/ ?>