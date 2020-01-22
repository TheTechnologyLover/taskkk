<?php $__env->startPush('style'); ?>
    <style>
        .chatCard ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        .chatCard ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        .chatCard ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        .chatCard ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        li {
            list-style: none;
        }

        .user-wrapper, .message-wrapper {
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #f9f9f9 !important;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #f9f9f9 !important;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #f9f9f9 !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <?php if($currantWorkspace || Auth::user()->type == 'admin'): ?>
            
            <div class="row mt-4">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card chatCard">
                        <div class="card-header">
                            <h4 class="d-inline">Chats</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xl-3">
                                    <div class="user-wrapper rounded">
                                        <ul class="list-unstyled list-unstyled-border users">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="media p-3 mb-0 user" id="<?php echo e($user->id); ?>">
                                                    <img class="mr-3 rounded-circle" width="50" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" <?php else: ?> avatar="<?php echo e($user->name); ?>" <?php endif; ?> alt="avatar">
                                                    <div class="media-body">
                                                        <?php if($user->unread): ?>
                                                            <div class="badge badge-pill badge-danger mt-3 float-right pending"><?php echo e($user->unread); ?></div>
                                                        <?php endif; ?>
                                                        <div class="mt-0 mb-1 font-weight-bold"><?php echo e($user->name); ?></div>
                                                        <div class="text-small font-weight-600 text-muted"><?php echo e($user->email); ?></div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9 col-lg-9 col-sm-9 col-xl-9" id="messages">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">
                        <h1>404</h1>
                        <div class="page-description">
                            <?php echo e(__('Page Not Found')); ?>

                        </div>
                        <div class="page-search">
                            <p class="text-muted mt-3"><?php echo e(__('It\'s looking like you may have taken a wrong turn. Don\'t worry... it happens to the best of us. Here\'s a little tip that might help you get back on track.')); ?></p>
                            <div class="mt-3">
                                <a class="btn btn-info mt-3" href="<?php echo e(route('home')); ?>"><i class="mdi mdi-reply"></i> <?php echo e(__('Return Home')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        var receiver_id = '';
        var my_id = "<?php echo e(Auth::id()); ?>";
        var workspaceId = "<?php echo e($currantWorkspace->id); ?>";
        

        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('71133ee6f4f8e5223ab1', {
                cluster: 'ap2',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                // alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();

                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "<?php echo e(URL::to('/')); ?>/" + workspaceId + "/message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            $(document).on('keyup', '.input-text input', function (e) {
                var message = $(this).val();
                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '' && workspaceId != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "workspace_id=" + workspaceId + "&receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });
        });

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Taskly2/site2/resources/views/chats/index.blade.php ENDPATH**/ ?>