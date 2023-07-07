<?php $__env->startPush('styles_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Daftar konsultan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Konsultan</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total konsultan</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalConsultants); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Konsultan Tersedia</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($availableConsultants); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-times"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Konsultan tidak Tersedia</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($unavailableConsultants); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users-slash"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Konsultan Tanpa pertemuan</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($consultantsWithoutAppointment); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form class="mb-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" class="form-control" name="search" value="<?php echo e(request()->get('search')); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="from" value="<?php echo e(request()->get('from')); ?>" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal akhir</label>
                                    <div class="input-group">
                                        <input type="date" id="lsdate" class="text-center form-control" name="to" value="<?php echo e(request()->get('to')); ?>" placeholder="End Date">
                                    </div>
                                </div>
                            </div>


                            


                            


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Grup pengguna</label>
                                    <select name="group_id" class="form-control populate">
                                        <option value="">Pilih grup pengguna</option>
                                        <?php $__currentLoopData = $userGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($userGroup->id); ?>" <?php if(request()->get('group_id') == $userGroup->id): ?> selected <?php endif; ?>><?php echo e($userGroup->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="disabled" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua status</option>
                                        <option value="0" <?php if(request()->get('disabled') == '0'): ?> selected <?php endif; ?>>Tersedia</option>
                                        <option value="1" <?php if(request()->get('disabled') == '1'): ?> selected <?php endif; ?>>Tidak tersedia</option>
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
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_consultants_export_excel')): ?>
                        <a href="/admin/consultants/excel?<?php echo e(http_build_query(request()->all())); ?>" class="btn btn-primary">Export excel</a>
                    <?php endif; ?>

                    <div class="h-10"></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-center">
                        <table class="table table-striped font-14">
                            <tr>
                                <th>ID</th>
                                <th class="text-left">Nama</th>
                                <th>Pertemuan</th>
                                <th>Pertemuan tertunda</th>
                                
                                <th>Grup pengguna</th>
                                <th>
                                    tanggal Registrasi</th>
                                <th>Status</th>
                                <th width="120">Aksi</th>

                            </tr>

                            <?php $__currentLoopData = $consultants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($consultant->id); ?></td>

                                    <td class="text-left">
                                     <div class="d-flex align-items-center">
                                        <figure class="avatar mr-2">
                                            <img src="<?php echo e($consultant->getAvatar()); ?>" alt="...">
                                        </figure>
                                        <div class="media-body ml-1">
                                            <div class="mt-0 mb-1 font-weight-bold"><?php echo e($consultant->full_name); ?></div>
                                            <div class="text-primary text-small font-600-bold"><?php echo e($consultant->mobile); ?></div>
                                        </div>
                                       </div>
                                    </td>

                                    <td>
                                        <div class="media-body">
                                            <div class="text-primary mt-0 mb-1 font-weight-bold"><?php echo e($consultant->sales_count); ?></div>

                                            
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <?php echo e($consultant->pendingAppointments); ?>

                                    </td>

                                    

                                    <td><?php echo e(!empty($consultant->userGroup) ? $consultant->userGroup->group->name : '-'); ?></td>

                                    <td><?php echo e(dateTimeFormat($consultant->created_at, 'j M Y | H:i')); ?></td>

                                    <td>
                                        <?php if($consultant->disabled): ?>
                                            <div class="text-danger mt-0 mb-1 font-weight-bold">Tidak tersedian</div>
                                        <?php else: ?>
                                            <div class="text-success mt-0 mb-1 font-weight-bold">Tersedia</div>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center mb-2" width="120">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_impersonate')): ?>
                                            <a href="/admin/users/<?php echo e($consultant->id); ?>/impersonate" target="_blank" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Masuk">
                                                <i class="fa fa-user-shield"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_edit')): ?>
                                            <a href="/admin/users/<?php echo e($consultant->id); ?>/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_delete')): ?>
                                            <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/users/'.$consultant->id.'/delete' , 'btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <?php echo e($consultants->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                </div>
            </div>

            <section class="card">
                <div class="card-body">
           <div class="section-title ml-0 mt-0 mb-3"> <h4>Petunjuk</h4> </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="media-body">
                                <div class="text-primary mt-0 mb-1 font-weight-bold">Menjadi Konsultan</div>
                                <div class=" text-small font-600-bold">Instruktur yang menentukan lembar waktu pertemuan mereka akan ditampilkan dalam daftar ini. Instruktur dapat menentukan lembar waktu pertemuan dari panel mereka.</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="media-body">
                                <div class="text-primary mt-0 mb-1 font-weight-bold">
                                    Pertemuan Tertunda</div>
                                <div class=" text-small font-600-bold">Pertemuan yang dipesan oleh peserta tetapi belum dilakukan. Tertunda, mungkin sedang berlangsung atau belum dimulai.</div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="media-body">
                                <div class="text-primary mt-0 mb-1 font-weight-bold">Konsultan Tidak Tersedia</div>
                                <div class="text-small font-600-bold">Instruktur mungkin tidak tersedia untuk sementara. Mereka dapat mengubah status dari pengaturan pertemuan di panel pengguna.</div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/consultants/lists.blade.php ENDPATH**/ ?>