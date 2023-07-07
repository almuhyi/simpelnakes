<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan SaaS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="<?php echo e(route('adminRegistrationPackagesLists')); ?>">Paket SaaS</a></div>
                <div class="breadcrumb-item ">Pengaturan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Umum</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " id="instructors-tab" data-toggle="tab" href="#instructors" role="tab" aria-controls="instructors" aria-selected="true">Instruktur</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " id="organizations-tab" data-toggle="tab" href="#organizations" role="tab" aria-controls="organizations" aria-selected="true">Organisasi</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                <?php echo $__env->make('admin.financial.registration_packages.settings.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('admin.financial.registration_packages.settings.instructors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('admin.financial.registration_packages.settings.organizations', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

    <script src="/assets/default/js/admin/registration_packages_settings.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/financial/registration_packages/settings/index.blade.php ENDPATH**/ ?>