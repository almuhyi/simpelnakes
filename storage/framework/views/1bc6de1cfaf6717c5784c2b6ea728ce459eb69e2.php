<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <style>
        .select2-container {
            z-index: 1212 !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($webinar->title); ?> - <?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item"><a><?php echo e($pageTitle); ?></a></div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Peserta</h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($totalStudents); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-briefcase"></i></div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Peserta aktif</h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($totalActiveStudents); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-info-circle"></i></div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Akses expired (peserta)</h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($totalExpireStudents); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-ban"></i></div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pembelajaran rata-rata</h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($averageLearning); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="card">
        <div class="card-body">
            <form method="get" class="mb-0">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Cari</label>
                            <input name="full_name" type="text" class="form-control" value="<?php echo e(request()->get('full_name')); ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Tanggal mulai</label>
                            <div class="input-group">
                                <input type="date" id="from" class="text-center form-control" name="from" value="<?php echo e(request()->get('from')); ?>" placeholder="Start Date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Tanggal selesai</label>
                            <div class="input-group">
                                <input type="date" id="to" class="text-center form-control" name="to" value="<?php echo e(request()->get('to')); ?>" placeholder="End Date">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Filter</label>
                            <select name="sort" data-plugin-selectTwo class="form-control populate">
                                <option value="">Jenis filter</option>
                                <option value="rate_asc" <?php if(request()->get('sort') == 'rate_asc'): ?> selected <?php endif; ?>>Ulasan ASC</option>
                                <option value="rate_desc" <?php if(request()->get('sort') == 'rate_desc'): ?> selected <?php endif; ?>>Ulasan DESC</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Grup pengguna</label>
                            <select name="group_id" data-plugin-selectTwo class="form-control populate">
                                <option value="">Pilih grup pengguna</option>
                                <?php $__currentLoopData = $userGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($userGroup->id); ?>" <?php if(request()->get('group_id') == $userGroup->id): ?> selected <?php endif; ?>><?php echo e($userGroup->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Role</label>
                            <select name="role_id" class="form-control">
                                <option value="">Semua role</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php if($role->id == request()->get('role_id')): ?> selected <?php endif; ?>><?php echo e($role->caption); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Status</label>
                            <select name="status" data-plugin-selectTwo class="form-control populate">
                                <option value="">Semua status</option>
                                <option value="active" <?php if(request()->get('status') == 'active'): ?> selected <?php endif; ?>>Aktif</option>
                                <option value="expire" <?php if(request()->get('status') == 'expire'): ?> selected <?php endif; ?>>Expired</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group mt-1">
                            <label class="input-label mb-4"> </label>
                            <input type="submit" class="text-center btn btn-primary w-100" value="Lihat hasil">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_notification_to_students')): ?>
                <a href="/admin/webinars/<?php echo e($webinar->id); ?>/sendNotification" class="btn btn-primary mr-2">Kirim notifikasi</a>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment_add_student_to_items')): ?>
                <button type="button" id="addStudentToCourse" class="btn btn-primary mr-2">Tambah peserta ke pelatihan</button>
            <?php endif; ?>
            <div class="h-10"></div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table table-striped font-14">
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Nama</th>
                        <th>Rating (5)</th>
                        <th>Proses</th>
                        <th>Grup pengguna</th>
                        <th>Tanggal mengikuti</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>

                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td class="text-left"><?php echo e($student->id); ?></td>
                            <td class="text-left">
                                <div class="d-flex align-items-center">
                                    <figure class="avatar mr-2">
                                        <img src="<?php echo e($student->getAvatar()); ?>" alt="<?php echo e($student->full_name); ?>">
                                    </figure>
                                    <div class="media-body ml-1">
                                        <div class="mt-0 mb-1 font-weight-bold"><?php echo e($student->full_name); ?></div>

                                        <?php if($student->mobile): ?>
                                            <div class="text-primary text-small font-600-bold"><?php echo e($student->mobile); ?></div>
                                        <?php endif; ?>

                                        <?php if($student->email): ?>
                                            <div class="text-primary text-small font-600-bold"><?php echo e($student->email); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span><?php echo e($student->rates ?? '-'); ?></span>
                            </td>

                            <td>
                                <span><?php echo e($student->learning); ?>%</span>
                            </td>

                            <td>
                                <?php if(!empty($student->getUserGroup())): ?>
                                    <span><?php echo e($student->getUserGroup()->name); ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td><?php echo e(dateTimeFormat($student->purchase_date, 'j M Y | H:i')); ?></td>

                            <td>
                                <?php if(!empty($webinar->access_days) and !$webinar->checkHasExpiredAccessDays($student->purchase_date)): ?>
                                    <div class="mt-0 mb-1 font-weight-bold text-warning">Expired</div>
                                <?php elseif(!$student->access_to_purchased_item): ?>
                                    <div class="mt-0 mb-1 font-weight-bold text-danger">Akses diblokir</div>
                                <?php else: ?>
                                    <div class="mt-0 mb-1 font-weight-bold text-success">Aktif</div>
                                <?php endif; ?>
                            </td>

                            <td class="text-center mb-2" width="120">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_impersonate')): ?>
                                    <a href="/admin/users/<?php echo e($student->id); ?>/impersonate" target="_blank" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Masuk">
                                        <i class="fa fa-user-shield"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_edit')): ?>
                                    <a href="/admin/users/<?php echo e($student->id); ?>/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_students_delete')): ?>
                                    <?php if(!$student->access_to_purchased_item): ?>
                                        <?php echo $__env->make('admin.includes.delete_button',[
                                            'url' => '/admin/enrollments/'. $student->sale_id .'/enable-access',
                                            'tooltip' => 'Aktifkan akses peserta',
                                            'btnIcon' => 'fa-check'
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php else: ?>
                                        <?php echo $__env->make('admin.includes.delete_button',[
                                                    'url' => '/admin/enrollments/'. $student->sale_id .'/block-access',
                                                    'tooltip' => 'Blokir Akses',
                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>

        <div class="card-footer text-center">
            <?php echo e($students->appends(request()->input())->links()); ?>

        </div>

    </div>


    <section class="card">
        <div class="card-body">
            <div class="section-title ml-0 mt-0 mb-3"><h5>Petunjuk</h5></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Peserta baru</div>
                        <div class=" text-small font-600-bold">Anda dapat menambahkan peserta baru dari "Pengguna/Baru" atau mengisi formulir pendaftaran di bagian depan platform.</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Tertunda/Aktif</div>
                        <div class=" text-small font-600-bold">
                            Pengguna yang memverifikasi email atau nomor telepon mereka akan dianggap sebagai "Aktif" dan bagi pengguna yang tidak memverifikasi email atau telepon akan dianggap sebagai "Tertunda".</div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Tidak aktif/Ban</div>
                        <div class="text-small font-600-bold">Pengguna yang diblokir tidak akan dapat masuk untuk periode tertentu. Pengguna yang tidak aktif tidak akan bisa masuk dan akses apapun sama sekali.</div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <div id="addStudentToCourseModal" class="d-none">
        <h3 class="section-title after-line">Menambahkan peserta ke pelatihan</h3>
        <div class="mt-25">
            <form action="/admin/enrollments/store" method="post">
                <input type="hidden" name="webinar_id" value="<?php echo e($webinar->id); ?>">

                <div class="form-group">
                    <label class="input-label d-block">Pengguna</label>
                    <select name="user_id" class="form-control user-search" data-placeholder="Cari pengguna">

                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-3">
                    <button type="button" class="js-save-manual-add btn btn-sm btn-primary">Simpan</button>
                    <button type="button" class="close-swl btn btn-sm btn-danger ml-2">Tutup</button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>

    <script>
        var saveSuccessLang = '<?php echo e(('Item berhasil ditambahkan.')); ?>';
    </script>

    <script src="/assets/default/js/admin/webinar_students.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/webinars/students.blade.php ENDPATH**/ ?>