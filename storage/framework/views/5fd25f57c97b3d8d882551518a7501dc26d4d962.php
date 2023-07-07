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

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_pages_create')): ?>
                                <a href="/admin/pages/create" class="btn btn-primary">Tambah baru</a>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Nama</th>
                                        <th>URL</th>
                                        <th class="text-center">Akses Robot SEO</th>
                                        <th class="text-center">Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($page->name); ?></td>
                                            <td><?php echo e($page->link); ?></td>
                                            <td class="text-center">
                                                <?php if($page->robot): ?>
                                                    <span class="text-success">Mengikuti</span>
                                                <?php else: ?>
                                                    <span class="text-danger">Tidak mengikuti</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if($page->status == 'publish'): ?>
                                                    <span class="text-success">Publish</span>
                                                <?php else: ?>
                                                    <span class="text-warning">Draft</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(dateTimeFormat($page->created_at, 'j M Y | H:i')); ?></td>
                                            <td width="150px">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_pages_edit')): ?>
                                                    <a href="/admin/pages/<?php echo e($page->id); ?>/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_pages_toggle')): ?>
                                                    <a href="/admin/pages/<?php echo e($page->id); ?>/toggle" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="<?php echo e(($page->status == 'draft') ? 'Publish' : 'Draft'); ?>">
                                                        <?php if($page->status == 'draft'): ?>
                                                            <i class="fa fa-arrow-up"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-arrow-down"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_pages_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/pages/'.$page->id.'/delete' , 'btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($pages->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/pages/lists.blade.php ENDPATH**/ ?>