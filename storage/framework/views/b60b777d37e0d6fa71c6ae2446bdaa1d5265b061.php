<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item"><?php echo e($pageTitle); ?></div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input name="full_name" type="text" class="form-control" value="<?php echo e(request()->get('full_name')); ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Role</label>
                                    <select name="role_id" class="form-control">
                                        <option value="">Semua</option>
                                        <?php $__currentLoopData = $staffsRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php if(!empty(request()->get('role_id')) and request()->get('role_id') == $role->id): ?> selected <?php endif; ?>><?php echo e($role->caption); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="Lihat hasil">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Id</th>
                                        <th class="text-left">Nama</th>
                                        <th>Role pengguna</th>
                                        <th>Tanggal registrasi</th>
                                        <th>Status</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->id); ?></td>
                                            <td class="text-left">
                                                <div class="d-flex align-items-center">
                                                    <figure class="avatar mr-2">
                                                        <img src="<?php echo e($user->getAvatar()); ?>" alt="<?php echo e($user->full_name); ?>">
                                                    </figure>
                                                    <div class="media-body ml-1">
                                                        <div class="mt-0 mb-1 font-weight-bold"><?php echo e($user->full_name); ?></div>

                                                        <?php if($user->mobile): ?>
                                                            <div class="text-primary text-small font-600-bold"><?php echo e($user->mobile); ?></div>
                                                        <?php endif; ?>

                                                        <?php if($user->email): ?>
                                                            <div class="text-primary text-small font-600-bold"><?php echo e($user->email); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center"><?php echo e($user->role->caption); ?></td>
                                            <td><?php echo e(dateTimeFormat($user->created_at, 'j M Y | H:i')); ?></td>

                                            <td>
                                                <div class="media-body">
                                                    <?php if($user->ban and !empty($user->ban_end_at) and $user->ban_end_at > time()): ?>
                                                        <div class="mt-0 mb-1 font-weight-bold text-danger">Banned</div>
                                                        <div class="text-small font-600-bold">Sampai <?php echo e(dateTimeFormat($user->ban_end_at, 'Y/m/j')); ?></div>
                                                    <?php else: ?>
                                                        <div class="mt-0 mb-1 font-weight-bold <?php echo e(($user->status == 'active') ? 'text-success' : 'text-warning'); ?>"><?php echo e($user->status); ?></div>
                                                        <div class="text-small font-600-bold <?php echo e(($user->verified ? ' text-success ' : ' text-warning ')); ?>">(<?php echo e(($user->verified ? 'verified' : 'not_verified')); ?>)</div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="text-center mb-2" width="120">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_edit')): ?>
                                                    <a href="/admin/users/<?php echo e($user->id); ?>/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/users/'.$user->id.'/delete' , 'btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($users->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/users/staffs.blade.php ENDPATH**/ ?>