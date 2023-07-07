<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Edit Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="/admin/users">Pengguna</a>
                </div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <?php if(!empty(session()->has('msg'))): ?>
            <div class="alert alert-success my-25">
                <?php echo e(session()->get('msg')); ?>

            </div>
        <?php endif; ?>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link <?php if(empty($becomeInstructor)): ?> active <?php endif; ?>" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true">Gambar</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="financial-tab" data-toggle="tab" href="#financial" role="tab" aria-controls="financial" aria-selected="true">Identitas</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="occupations-tab" data-toggle="tab" href="#occupations" role="tab" aria-controls="occupations" aria-selected="true">Profesi</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="badges-tab" data-toggle="tab" href="#badges" role="tab" aria-controls="badges" aria-selected="true">Lencana</a>
                                </li>

                                <?php if(!empty($user) and ($user->isOrganization() or $user->isTeacher())): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_update_user_registration_package')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="registrationPackage-tab" data-toggle="tab" href="#registrationPackage" role="tab" aria-controls="registrationPackage" aria-selected="true">Paket SaaS</a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>


                                <li class="nav-item">
                                    <a class="nav-link" id="meetingSettings-tab" data-toggle="tab" href="#meetingSettings" role="tab" aria-controls="meetingSettings" aria-selected="true">Pengaturan pertemuan</a>
                                </li>


                                <?php if(!empty($becomeInstructor)): ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if(!empty($becomeInstructor)): ?> active <?php endif; ?>" id="become_instructor-tab" data-toggle="tab" href="#become_instructor" role="tab" aria-controls="become_instructor" aria-selected="true">Detail Permintaan Instruktur</a>
                                    </li>
                                <?php endif; ?>


                                <li class="nav-item">
                                    <a class="nav-link" id="purchased_courses-tab" data-toggle="tab" href="#purchased_courses" role="tab" aria-controls="purchased_courses" aria-selected="true">Pelatihan</a>
                                </li>

                                

                                

                                <li class="nav-item">
                                    <a class="nav-link" id="topics-tab" data-toggle="tab" href="#topics" role="tab" aria-controls="topics" aria-selected="true">Forum</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">

                                <?php echo $__env->make('admin.users.editTabs.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.images', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.financial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.occupations', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.badges', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php if(!empty($user) and ($user->isOrganization() or $user->isTeacher())): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_update_user_registration_package')): ?>
                                        <?php echo $__env->make('admin.users.editTabs.registration_package', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>


                                <?php echo $__env->make('admin.users.editTabs.meeting_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                                <?php if(!empty($becomeInstructor)): ?>
                                    <?php echo $__env->make('admin.users.editTabs.become_instructor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php echo $__env->make('admin.users.editTabs.purchased_courses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.purchased_bundles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.purchased_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.topics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>

    <script>
        var saveSuccessLang = '<?php echo e(('Item berhasil ditambahkan.')); ?>';
    </script>

    <script src="/assets/default/js/admin/webinar_students.min.js"></script>
    <script src="/assets/default/js/admin/user_edit.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>