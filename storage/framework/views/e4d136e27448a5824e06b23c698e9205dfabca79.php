<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(trans('admin/main.financial_settings')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/"><?php echo e(trans('admin/main.dashboard')); ?></a></div>
                <div class="breadcrumb-item active"><a href="/admin/settings"><?php echo e(trans('admin/main.settings')); ?></a></div>
                <div class="breadcrumb-item "><?php echo e(trans('admin/main.financial')); ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link  <?php if(empty(request()->get('page'))): ?> active <?php endif; ?>" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true"><?php echo e(trans('admin/main.basic')); ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " id="offline_banks_credits-tab" data-toggle="tab" href="#offline_banks_credits" role="tab" aria-controls="offline_banks_credits" aria-selected="true"><?php echo e(trans('admin/main.offline_banks_credits')); ?></a>
                                </li>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_payment_channel')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if(!empty(request()->get('page'))): ?> active <?php endif; ?>" id="payment_channels-tab" data-toggle="tab" href="#payment_channels" role="tab" aria-controls="payment_channels" aria-selected="true"><?php echo e(trans('admin/main.payment_channels')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <li class="nav-item">
                                    <a class="nav-link " id="referral-tab" data-toggle="tab" href="#referral" role="tab" aria-controls="referral" aria-selected="true"><?php echo e(trans('admin/main.referral')); ?></a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                <?php echo $__env->make('admin.settings.financial.basic',['itemValue' => (!empty($settings) and !empty($settings['financial'])) ? $settings['financial']->value : ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('admin.settings.financial.site_bank_accounts',['itemValue' => (!empty($settings) and !empty($settings['site_bank_accounts'])) ? $settings['site_bank_accounts']->value : ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_payment_channel')): ?>
                                    <?php echo $__env->make('admin.settings.financial.payment_channel.lists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php echo $__env->make('admin.settings.financial.referral',['itemValue' => (!empty($settings) and !empty($settings['referral'])) ? $settings['referral']->value : ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/settings/financial.blade.php ENDPATH**/ ?>