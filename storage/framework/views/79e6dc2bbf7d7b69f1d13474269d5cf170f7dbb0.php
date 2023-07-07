<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item "><a href="/admin/forums">Forum</a></div>
                <div class="breadcrumb-item active"><?php echo e($pageTitle); ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_topics_create')): ?>
                                <a href="/admin/forums/topics/create" class="btn btn-primary ml-2">Topik baru</a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th class="text-left">Judul</th>
                                        <th>Pembuat</th>
                                        <th>Post / komentar</th>
                                        <th>Status</th>
                                        <th>
                                            Tanggal Dibuat</th>
                                        <th>Tanggal Diperbarui</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td class="text-left">
                                                <a href="/admin/forums/<?php echo e($topic->forum_id); ?>/topics/<?php echo e($topic->id); ?>/posts">
                                                    <?php echo e($topic->title); ?>

                                                </a>
                                            </td>
                                            <td><?php echo e($topic->creator->full_name); ?></td>
                                            <td><?php echo e($topic->posts_count); ?></td>
                                            <td>
                                                <?php if($topic->close): ?>
                                                    <span class="text-danger">Ditutup</span>
                                                <?php else: ?>
                                                    <span class="text-success">Dibuka</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?php echo e(dateTimeFormat($topic->created_at,'j M Y | H:i')); ?></td>
                                            <td class="text-center"><?php echo e((!empty($topic->posts) and count($topic->posts)) ? dateTimeFormat($topic->posts->first()->created_at,'j M Y | H:i') : '-'); ?></td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_topics_lists')): ?>
                                                    <?php if(!$topic->close): ?>
                                                        <?php echo $__env->make('admin.includes.delete_button',[
                                                            'url' => "/admin/forums/{$topic->forum_id}/topics/{$topic->id}/close",
                                                            'tooltip' => 'Tutup',
                                                            'btnClass' => 'mr-1',
                                                            'btnIcon' => 'fa-lock'
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php else: ?>
                                                        <?php echo $__env->make('admin.includes.delete_button',[
                                                            'url' => "/admin/forums/{$topic->forum_id}/topics/{$topic->id}/open",
                                                            'tooltip' => 'Buka',
                                                            'btnClass' => 'mr-1',
                                                            'btnIcon' => 'fa-unlock'
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_topics_posts')): ?>
                                                    <a href="/admin/forums/<?php echo e($topic->forum_id); ?>/topics/<?php echo e($topic->id); ?>/posts"
                                                       class="btn-transparent btn-sm text-primary mr-1"
                                                       data-toggle="tooltip" data-placement="top" title="Post"
                                                    >
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_topics_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button', [
                                                            'url' => '/admin/forums/'.$topic->forum_id.'/topics/'.$topic->id.'/delete',
                                                            'btnClass' => 'btn-sm'
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($topics->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/forums/topics/lists.blade.php ENDPATH**/ ?>