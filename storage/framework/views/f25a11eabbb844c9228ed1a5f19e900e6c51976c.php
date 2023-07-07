<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Paket SaaS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Paket SaaS</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users-cog	"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalPackages); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-tie"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>
                                Paket Instruktur Aktif</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalActiveByInstructors); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-briefcase"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Paket Organisasi Aktif</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalActiveByOrganization); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Judul</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Hari</th>
                                        <th class="text-center">Jumlah Penjualan pelatihan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Tanggal dibuat</th>
                                        <th>Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo e($package->icon); ?>" width="50" height="50" alt="">
                                            </td>
                                            <td class="text-left"><?php echo e($package->title); ?></td>
                                            <td class="text-center"><?php echo e($package->role); ?></td>
                                            <td class="text-center"><?php echo e(addCurrencyToPrice($package->price)); ?></td>
                                            <td class="text-center"><?php echo e($package->days); ?></td>
                                            <td class="text-center"><?php echo e($package->sales->count()); ?></td>
                                            <td class="text-center">
                                                <span class="<?php echo e($package->status == 'active' ? 'text-success' : 'text-danger'); ?>"><?php echo e($package->status); ?></span>
                                            </td>
                                            <td class="text-center"><?php echo e(dateTimeFormat($package->created_at, 'Y M j | H:i')); ?></td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_registration_packages_edit')): ?>
                                                    <a href="/admin/financial/registration-packages/<?php echo e($package->id); ?>/edit" class="btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_registration_packages_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/financial/registration-packages/'. $package->id.'/delete','btnClass' => 'btn-sm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($packages->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="card">
        <div class="card-body">
            <div class="section-title ml-0 mt-0 mb-3"><h5>Petunjuk</h5></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Statistik Paket</div>
                        <div class=" text-small font-600-bold">Anda dapat melihat jumlah paket yang diaktifkan berdasarkan peran pengguna yang berbeda.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">
                        Parameter Bawaan</div>
                        <div class=" text-small font-600-bold">Jangan batasi pengguna untuk paket. Tetapkan nilai default dari SaaS/Pengaturan dan biarkan mereka mencoba platofrm Anda.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/financial/registration_packages/lists.blade.php ENDPATH**/ ?>