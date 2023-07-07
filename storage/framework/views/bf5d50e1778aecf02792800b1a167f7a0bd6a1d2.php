<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Hasil</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Hasil</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_quiz_result_export_excel')): ?>
                                <div class="text-right">
                                    <a href="/admin/quizzes/<?php echo e($quiz_id); ?>/results/excel" class="btn btn-primary">Export excel</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th class="text-left">Judul</th>
                                        <th class="text-left">Peserta</th>
                                        <th class="text-left">Instruktur</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">
                                            Tanggal Kuis</th>
                                        <th class="text-center">Status</th>
                                        <th>Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $quizzesResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <span><?php echo e($result->quiz->title); ?></span>
                                                <small class="d-block text-left text-primary">(<?php echo e($result->quiz->webinar->title); ?>)</small>
                                            </td>
                                            <td class="text-left"><?php echo e($result->user->full_name); ?></td>
                                            <td class="text-left">
                                                <?php echo e($result->quiz->teacher->full_name); ?>

                                            </td>
                                            <td class="text-center">
                                                <span><?php echo e($result->user_grade); ?></span>
                                            </td>
                                            <td class="text-center"><?php echo e(dateTimeformat($result->created_at, 'j F Y')); ?></td>
                                            <td class="text-center">
                                                <?php switch($result->status):
                                                    case (\App\Models\QuizzesResult::$passed): ?>
                                                    <span class="text-success">Lulus</span>
                                                    <?php break; ?>

                                                    <?php case (\App\Models\QuizzesResult::$failed): ?>

                                                    <span class="text-danger">Gagal</span>
                                                    <?php break; ?>

                                                    <?php case (\App\Models\QuizzesResult::$waiting): ?>
                                                    <span class="text-warning">Menunggu</span>
                                                    <?php break; ?>

                                                <?php endswitch; ?>
                                            </td>

                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_quizzes_results_delete')): ?>
                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/quizzes/result/'. $result->id.'/delete'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($quizzesResults->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/quizzes/results.blade.php ENDPATH**/ ?>