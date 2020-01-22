<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5 mb-1">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <div class="border p-3 mt-4 mb-3 mt-lg-0 rounded">
                            <h4 class="header-title mb-3"><?php echo e(__('Order Summary')); ?></h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <img <?php if($plan->image): ?> src="<?php echo e(asset('/storage/plans/'.$plan->image)); ?>" <?php else: ?> avatar="<?php echo e($plan->name); ?>" <?php endif; ?> alt="plan image" class="rounded-circle rounded mr-2" height="48">
                                            <p class="m-0 d-inline-block align-middle">
                                                <a href="#" class="text-body font-weight-semibold"><?php echo e($plan->name); ?></a>
                                                <br>
                                                <small> <?php if($plan->duration!='Unlimited'): ?>$<?php echo e($plan->price); ?> / <?php endif; ?> <?php echo e(__($plan->duration)); ?> </small>
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            $<?php echo e(number_format($plan->price)); ?>

                                        </td>
                                    </tr>
                                    <tr class="text-right">
                                        <td>
                                            <h5 class="m-0"><?php echo e(__('Total')); ?>:</h5>
                                        </td>
                                        <td class="text-right font-weight-semibold">
                                            $<?php echo e(number_format($plan->price)); ?>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>

                        <?php if($plan->price <= 0): ?>

                            <form role="form" action="<?php echo e(route('update.user.plan')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                                <!-- end Credit/Debit Card box-->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="code" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                            <button class="btn btn-primary" type="submit">
                                                <?php echo e(__('Active Now')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        <?php else: ?>

                        <form role="form" action="<?php echo e(route('stripe.post')); ?>" method="post" class="require-validation"
                              data-cc-on-file="false"
                              data-stripe-publishable-key="<?php echo e(env('STRIPE_KEY')); ?>"
                              id="payment-form">
                            <?php echo csrf_field(); ?>
                            <!-- Credit/Debit Card box-->
                            <div class="border p-3 mb-3 rounded">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="custom-radio">
                                            <label class="font-16 font-weight-bold"><?php echo e(__('Credit / Debit Card')); ?></label>
                                        </div>
                                        <p class="mb-0 pt-1"><?php echo e(__('Safe money transfer using your bank account. We support Mastercard, Visa, Discover and American express.')); ?></p>
                                    </div>
                                    <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                        <img src="<?php echo e(asset('assets/img/payments/master.png')); ?>" height="24" alt="master-card-img">
                                        <img src="<?php echo e(asset('assets/img/payments/discover.png')); ?>" height="24" alt="discover-card-img">
                                        <img src="<?php echo e(asset('assets/img/payments/visa.png')); ?>" height="24" alt="visa-card-img">
                                        <img src="<?php echo e(asset('assets/img/payments/american express.png')); ?>" height="24" alt="american-express-card-img">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="card-number"><?php echo e(__('Card Number')); ?></label>
                                            <input type="text" id="card-number" class="form-control required" placeholder="4242 4242 4242 4242">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="card-name-on"><?php echo e(__('Name on card')); ?></label>
                                            <input type="text" name="name" id="card-name-on" class="form-control required" placeholder="<?php echo e(\Auth::user()->name); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="card-expiry-date"><?php echo e(__('Expiry date')); ?></label>
                                            <input type="text" id="card-expiry-date" class="form-control required" placeholder="MM/YYYY">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="card-cvv"><?php echo e(__('CVV code')); ?></label>
                                            <input type="text" id="card-cvv" class="form-control required" placeholder="123">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="error" style="display: none;">
                                            <div class='alert-danger alert'><?php echo e(__('Please correct the errors and try again.')); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end Credit/Debit Card box-->
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="text-sm-right">
                                        <input type="hidden" name="code" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="mdi mdi-cash-multiple mr-1"></i> <?php echo e(__('Pay Now')); ?> ($<?php echo e($plan->price); ?>)
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('#card-number').mask('0000 0000 0000 0000');
        $('#card-expiry-date').mask('00/0000');
        $('#card-cvv').mask('000');
    })
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            valid = true,
            $errorMessage = $form.find('div.error');
            $errorMessage.hide();

            $('.has-error').removeClass('has-error');
            // console.log($inputs);
            $form.find('.required').each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.show();
                    valid = false;
                }
            });
            if(!valid)
            {
                return false;
            }
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                $form.find('[type="submit"]').attr('disabled','disabled');
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                var expiry = $("#card-expiry-date").val().split("/");
                Stripe.createToken({
                    number: $('#card-number').val(),
                    cvc: $('#card-cvc').val(),
                    exp_month: expiry[0],
                    exp_year: expiry[1]
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                toastr('Error',response.error.message,'error');
                $form.find('[type="submit"]').removeAttr('disabled');
            } else {
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').not('#card-name-on').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.find('[type="submit"]').attr('disabled','disabled');
                $form.get(0).submit();
            }
        }

    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/taskly/saas/site/resources/views/stripe.blade.php ENDPATH**/ ?>