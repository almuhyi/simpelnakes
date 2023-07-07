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

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Icon</th>
                                        <th>Judul</th>
                                        <th>Topik</th>
                                        <th class="text-center">Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $recommendedTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommended): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td>
                                                <img src="<?php echo e($recommended->icon); ?>" alt="" width="48" height="48" class="">
                                            </td>

                                            <td class="text-center"><?php echo e($recommended->title); ?></td>

                                            <td class="text-center"><?php echo e($recommended->topics->count()); ?></td>

                                            <td class="text-center"><?php echo e(dateTimeFormat($recommended->created_at, 'j M Y | H:i')); ?></td>

                                            <td width="150">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_featured_topics_edit')): ?>
                                                    <a href="/admin/recommended-topics/<?php echo e($recommended->id); ?>/edit" class="btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_featured_topics_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/recommended-topics/'. $recommended->id .'/delete','btnClass' => 'btn-sm','icon' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($recommendedTopics->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/forums/recommended_topics/lists.blade.php ENDPATH**/ ?>