<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Template</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Template</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped font-14" id="datatable-basic">

                        <tr>
                            <th>Judul</th>
                            <th>Aksi</th>
                        </tr>

                        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($template->title); ?></td>

                                <td width="100">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_template_edit')): ?>
                                        <a href="/admin/notifications/templates/<?php echo e($template->id); ?>/edit" class="btn-transparent btn-sm text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_template_delete')): ?>
                                        <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/notifications/templates/'. $template->id.'/delete','btnClass' => 'btn-sm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>

                <div class="card-footer text-center">
                    <?php echo e($templates->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/notifications/templates.blade.php ENDPATH**/ ?>