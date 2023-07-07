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
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total forum</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalForums); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-comment-alt"></i>
                        </div>

                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total topik</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalTopics); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-comment"></i>
                        </div>

                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total post / komentar</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($postsCount); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-comments"></i>
                        </div>

                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>
                                    Anggota Aktif</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($membersCount); ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Icon</th>
                                        <th class="text-left">Judul</th>
                                        <?php if(empty(request()->get('subForums'))): ?>
                                            <th>Sub forum</th>
                                        <?php endif; ?>
                                        <th>Topik</th>
                                        <th>Post / Komentar</th>
                                        <th>Status</th>
                                        <th>Ditutup</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $__currentLoopData = $forums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td>
                                                <img src="<?php echo e($forum->icon); ?>" width="30" alt="">
                                            </td>
                                            <td class="text-left">
                                                <?php if(!empty($forum->subForums) and count($forum->subForums)): ?>
                                                    <a href="/admin/forums?subForums=<?php echo e($forum->id); ?>"><?php echo e($forum->title); ?></a>
                                                <?php else: ?>
                                                    <a href="/admin/forums/<?php echo e($forum->id); ?>/topics"><?php echo e($forum->title); ?></a>
                                                <?php endif; ?>
                                            </td>
                                            <?php if(empty(request()->get('subForums'))): ?>
                                                <td>
                                                    <?php if(!empty($forum->subForums)): ?>
                                                        <?php echo e(count($forum->subForums)); ?>

                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                            <td><?php echo e($forum->topics_count); ?></td>
                                            <td><?php echo e($forum->posts_count); ?></td>
                                            <td>
                                                <?php echo e($forum->status); ?>

                                            </td>
                                            <td>
                                                <?php if($forum->close): ?>
                                                   Ya
                                                <?php else: ?>
                                                    Tidak
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(!empty($forum->subForums) and count($forum->subForums)): ?>
                                                    <a href="/admin/forums?subForums=<?php echo e($forum->id); ?>"
                                                       class="btn-transparent btn-sm text-primary mr-1"
                                                       data-toggle="tooltip" data-placement="top" title="Forum"
                                                    >
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_topics_lists')): ?>
                                                        <a href="/admin/forums/<?php echo e($forum->id); ?>/topics"
                                                           class="btn-transparent btn-sm text-primary mr-1"
                                                           data-toggle="tooltip" data-placement="top" title="Topik"
                                                        >
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_edit')): ?>
                                                    <a href="/admin/forums/<?php echo e($forum->id); ?>/edit"
                                                       class="btn-transparent btn-sm text-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/forums/'.$forum->id.'/delete'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($forums->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/forums/lists.blade.php ENDPATH**/ ?>