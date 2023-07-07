<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title">Statistik sertifikat saya</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/56.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-500 mt-5"><?php echo e($certificatesCount); ?></strong>
                        <span class="font-16 font-weight-bold text-gray">Sertifikat</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/hours.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-500 mt-5"><?php echo e($avgGrades); ?></strong>
                        <span class="font-16 font-weight-bold text-gray">Nilai rata-rata</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/60.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-500 mt-5"><?php echo e($failedQuizzes); ?></strong>
                        <span class="font-16 font-weight-bold text-gray">Kuis gagal</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <h2 class="section-title">Filter sertifikat</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="" method="get" class="row">
                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label">Dari</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="from" autocomplete="off" class="form-control <?php if(!empty(request()->get('from'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>" value="<?php echo e(request()->get('from','')); ?>" aria-describedby="dateInputGroupPrepend"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label">Sampai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="to" autocomplete="off" class="form-control <?php if(!empty(request()->get('to'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>" value="<?php echo e(request()->get('to','')); ?>" aria-describedby="dateInputGroupPrepend"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label class="input-label">Pelatihan</label>
                                <select name="webinar_id" class="form-control">
                                    <option value="all">Semua pelatihan</option>

                                    <?php $__currentLoopData = $userWebinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userWebinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($userWebinar->id); ?>" <?php if(request()->get('webinar_id','') == $userWebinar->id): ?> selected <?php endif; ?>><?php echo e($userWebinar->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">Kuis</label>
                                        <select id="quizFilter" name="quiz_id" class="form-control" <?php if(empty(request()->get('quiz_id'))): ?> disabled <?php endif; ?>>
                                            <option value="all">Semua kuis</option>

                                            <?php $__currentLoopData = $userAllQuizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userQuiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($userQuiz->id); ?>" data-webinar-id="<?php echo e($userQuiz->webinar_id); ?>" <?php if(request()->get('quiz_id','') == $userQuiz->id): ?> selected <?php else: ?> class="d-none" <?php endif; ?>><?php echo e($userQuiz->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">Nilai</label>
                                        <input type="text" name="grade" value="<?php echo e(request()->get('grade','')); ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Lihat hasil</button>
                </div>
            </form>
        </div>
    </section>

    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Sertifikat saya</h2>
        </div>

        <?php if(!empty($quizzes) and count($quizzes)): ?>
            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th>Sertifikat</th>
                                    <th class="text-center">ID Sertifikat</th>
                                    <th class="text-center">Minimal nilai</th>
                                    <th class="text-center">Nilai rata-rata</th>
                                    <th class="text-center">Nilai saya</th>
                                    <th class="text-center">Tanggal</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-left">
                                            <span class="d-block text-dark-blue font-weight-500"><?php echo e($quiz->title); ?></span>
                                            <span class="d-block font-12 text-gray mt-5"><?php echo e($quiz->webinar->title); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <?php if($quiz->can_download_certificate): ?>
                                                <?php
                                                    $getUserCertificate = $quiz->getUserCertificate($authUser,$quiz->result);
                                                ?>

                                                <?php if(!empty($getUserCertificate)): ?>
                                                    <?php echo e($getUserCertificate->id); ?>

                                                <?php endif; ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500"><?php echo e($quiz->pass_mark); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500"><?php echo e($quiz->total_mark); ?></span>
                                        </td>
                                        <td class="align-middle"><?php echo e($quiz->result->user_grade); ?></td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500"><?php echo e(dateTimeFormat($quiz->result->created_at, 'j M Y')); ?></span>
                                        </td>
                                        <td class="align-middle font-weight-normal">
                                            <?php if($quiz->can_download_certificate): ?>
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" height="20"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="<?php echo e(url('')); ?>/panel/quizzes/results/<?php echo e($quiz->result->id); ?>/showCertificate" target="_blank" class="webinar-actions d-block">Buka</a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                'file_name' => 'cert.png',
                'title' => ('Anda tidak memiliki sertifikat!'),
                'hint' => nl2br(('Anda dapat memperoleh sertifikat yang valid dengan mendaftar di pelatihan.')),
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>

    <div class="my-30">
        <?php echo e($quizzes->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/certificates.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/certificates/achievements.blade.php ENDPATH**/ ?>