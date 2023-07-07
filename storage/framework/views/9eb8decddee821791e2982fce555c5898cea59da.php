<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Pelatihan</div>

                <div class="breadcrumb-item"><?php echo e($pageTitle); ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14 ">
                                    <tr>
                                        <th>ID pelatihan</th>
                                        <th class="text-left">Pelatihan</th>
                                        <th class="text-left">Instruktur</th>
                                        <th>Pertanyaan</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="text-center">
                                            <td><?php echo e($webinar->id); ?></td>
                                            <td width="18%" class="text-left">
                                                <a class="text-primary mt-0 mb-1 font-weight-bold" href="<?php echo e($webinar->getUrl()); ?>"><?php echo e($webinar->title); ?></a>
                                            </td>

                                            <td class="text-left"><?php echo e($webinar->teacher->full_name); ?></td>

                                            <td class=""><?php echo e($webinar->forums_count); ?></td>


                                            <td width="200" class="btn-sm">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_course_question_forum_list')): ?>
                                                    <a href="/admin/webinars/<?php echo e($webinar->id); ?>/forums" target="_blank" class="btn-transparent btn-sm text-primary mt-1 mr-1" data-toggle="tooltip" data-placement="top" title="Pertanyaan">
                                                        <i class="fa fa-question"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($webinars->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/webinars/forum/course_lists.blade.php ENDPATH**/ ?>