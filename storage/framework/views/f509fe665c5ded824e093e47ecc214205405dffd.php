<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title">
            Statistik Penugasan</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/homework.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5"><?php echo e($courseAssignmentsCount); ?></strong>
                        <span class="font-16 text-dark-blue text-gray font-weight-500">
                            Tugas pelatihan</span>
                    </div>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/58.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5"><?php echo e($pendingReviewCount); ?></strong>
                        <span class="font-16 text-dark-blue text-gray font-weight-500">
                            Tinjauan tertunda</span>
                    </div>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/45.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($passedCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">
                            Lulus</span>
                    </div>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/pin.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($failedCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Gagal</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <h2 class="section-title">Filter tugas</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="<?php echo e(url('/panel/assignments/my-assignments')); ?>" method="get" class="row">
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
                                    <input type="text" name="from" autocomplete="off" class="form-control <?php if(!empty(request()->get('from'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>"
                                           aria-describedby="dateInputGroupPrepend" value="<?php echo e(request()->get('from','')); ?>"/>
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
                                    <input type="text" name="to" autocomplete="off" class="form-control <?php if(!empty(request()->get('to'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>"
                                           aria-describedby="dateInputGroupPrepend" value="<?php echo e(request()->get('to','')); ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="form-group">
                                <label class="input-label">Pelatihan</label>
                                <select name="webinar_id" class="form-control select2">
                                    <option value="">Semua pelatihan</option>

                                    <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($webinar->id); ?>" <?php if(request()->get('webinar_id') == $webinar->id): ?> selected <?php endif; ?>><?php echo e($webinar->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label class="input-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Semua</option>
                                    <?php $__currentLoopData = \App\Models\WebinarAssignmentHistory::$assignmentHistoryStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status); ?>" <?php echo e((request()->get('status') == $status) ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
            <h2 class="section-title">Tugas saya</h2>
        </div>

        <?php if($assignments->count() > 0): ?>

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th>Judul/Pelatihan</th>
                                    <th class="text-center">
                                        Tenggat waktu</th>
                                    <th class="text-center">Penyerahan pertama</th>
                                    <th class="text-center">Penyerahan terakhir</th>
                                    <th class="text-center">Percobaan</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Nilai lulus</th>
                                    <th class="text-center">Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-left">
                                            <span class="d-block font-16 font-weight-500 text-dark-blue"><?php echo e($assignment->title); ?></span>
                                            <span class="d-block font-12 font-weight-500 text-gray"><?php echo e($assignment->webinar->title); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e(!empty($assignment->deadline) ? dateTimeFormat($assignment->deadlineTime, 'j M Y') : '-'); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e(!empty($assignment->first_submission) ? dateTimeFormat($assignment->first_submission, 'j M Y | H:i') : '-'); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e(!empty($assignment->last_submission) ? dateTimeFormat($assignment->last_submission, 'j M Y | H:i') : '-'); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e(!empty($assignment->attempts) ? "{$assignment->usedAttemptsCount}/{$assignment->attempts}" : '-'); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span><?php echo e((!empty($assignment->assignmentHistory) and !empty($assignment->assignmentHistory->grade)) ? $assignment->assignmentHistory->grade : '-'); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span><?php echo e($assignment->pass_grade); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <?php if(empty($assignment->assignmentHistory) or ($assignment->assignmentHistory->status == \App\Models\WebinarAssignmentHistory::$notSubmitted)): ?>
                                                <span class="text-danger font-weight-500">Tidak diserahkan</span>
                                            <?php else: ?>
                                                <?php switch($assignment->assignmentHistory->status):
                                                    case (\App\Models\WebinarAssignmentHistory::$passed): ?>
                                                    <span class="text-primary font-weight-500">Lulus</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\WebinarAssignmentHistory::$pending): ?>
                                                    <span class="text-warning font-weight-500">Tertunda</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\WebinarAssignmentHistory::$notPassed): ?>
                                                    <span class="font-weight-500 text-danger">Gagal</span>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            <?php endif; ?>
                                        </td>


                                        <td class="align-middle text-right">

                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>

                                                <div class="dropdown-menu menu-lg">
                                                    <?php if($assignment->webinar->checkUserHasBought()): ?>
                                                        <a href="<?php echo e("{$assignment->webinar->getLearningPageUrl()}?type=assignment&item={$assignment->id}"); ?>" target="_blank"
                                                           class="webinar-actions d-block mt-10 font-weight-normal">
                                                           Lihat Tugas</a>
                                                    <?php else: ?>
                                                        <a href="#!" class="not-access-toast webinar-actions d-block mt-10 font-weight-normal">
                                                            Lihat Tugas</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-30">
                <?php echo e($assignments->appends(request()->input())->links('vendor.pagination.panel')); ?>

            </div>
        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                'file_name' => 'meeting.png',
                'title' => ('Tidak Ada Tugas!'),
                'hint' => nl2br(('Pelatihan Anda tidak menyertakan tugas apa pun.')),
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var notAccessToastTitleLang = '<?php echo e(('Akses ditolak')); ?>';
        var notAccessToastMsgLang = '<?php echo e(('Anda tidak memiliki akses ke konten ini.')); ?>';
    </script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/my_assignments.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/assignments/my-assignments.blade.php ENDPATH**/ ?>