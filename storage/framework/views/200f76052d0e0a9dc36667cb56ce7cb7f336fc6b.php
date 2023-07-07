<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Grup pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Grup pengguna</div>
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
                                        <th class="text-left">Nama</th>
                                        <th>Pengguna</th>
                                        <th>Komisi</th>
                                        <th>Diskon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($group->id); ?></td>
                                            <td class="text-left">
                                                <span><?php echo e($group->name); ?></span>
                                            </td>
                                            <td><?php echo e($group->groupUsers->count()); ?></td>
                                            <td><?php echo e($group->commission ?? 0); ?>%</td>
                                            <td><?php echo e($group->discount ?? 0); ?>%</td>
                                            <td>
                                                <span class="<?php echo e($group->status == 'active' ? 'text-success' : 'text-danger'); ?>"><?php echo e($group->status); ?></span>
                                            </td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_group_edit')): ?>
                                                    <a href="/admin/users/groups/<?php echo e($group->id); ?>/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_group_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/users/groups/'. $group->id.'/delete','btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($groups->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/users/groups/lists.blade.php ENDPATH**/ ?>