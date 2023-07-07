<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Sertifikat kuis</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Sertifikat kuis</div>
            </div>
        </div>

        <div class="section-body">
            <section class="card">
                <div class="card-body">
                    <form action="/admin/certificates" method="get" class="row mb-0">

                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="input-label">Judul</label>
                                <input type="text" name="quiz_title" class="form-control" value="<?php echo e(!empty($instructor) ? $instructor : ''); ?>"/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Instruktur</label>
                                <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role" class="form-control search-user-select2"
                                        data-placeholder="Search teachers">

                                    <?php if(!empty($teachers) and $teachers->count() > 0): ?>
                                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($teacher->id); ?>" selected><?php echo e($teacher->full_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Peserta</label>
                                <select name="student_ids[]" multiple="multiple" data-search-option="just_student_role" class="form-control search-user-select2"
                                        data-placeholder="Search students">

                                    <?php if(!empty($students) and $students->count() > 0): ?>
                                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($student->id); ?>" selected><?php echo e($student->full_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary w-100">Lihat hasil</button>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate_export_excel')): ?>
                                <div class="text-right">
                                    <a href="/admin/certificates/excel?<?php echo e(http_build_query(request()->all())); ?>" class="btn btn-primary">Export excel</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>No</th>
                                        <th class="text-left">Judul</th>
                                        <th class="text-left">Peserta</th>
                                        <th class="text-left">Instruktur</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($certificate->id); ?></td>
                                            <td class="text-left">
                                                <span><?php echo e($certificate->quiz->title); ?></span>
                                                <small class="d-block text-left"><?php echo e(!empty($certificate->quiz->webinar) ? $certificate->quiz->webinar->title : 'Hapus'); ?>)</small>
                                            </td>
                                            <td class="text-left"><?php echo e($certificate->student->full_name); ?></td>
                                            <td class="text-left"><?php echo e($certificate->quiz->teacher->full_name); ?></td>
                                            <td class="text-center"><?php echo e($certificate->quizzesResult->user_grade); ?></td>
                                            <td class="text-center"><?php echo e(dateTimeFormat($certificate->created_at, 'j M Y')); ?></td>
                                            <td>
                                                <a href="/admin/certificates/<?php echo e($certificate->id); ?>/download" target="_blank" class="btn-transparent text-primary" data-toggle="tooltip" title="Unduh sertifikat">
                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($certificates->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/certificates/lists.blade.php ENDPATH**/ ?>