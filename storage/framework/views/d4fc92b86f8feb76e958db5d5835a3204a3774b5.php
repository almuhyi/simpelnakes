<?php $__env->startPush('styles_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title">
            Statistik Penugasan</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/homework.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5"><?php echo e($courseAssignmentsCount); ?></strong>
                        <span class="font-16 text-dark-blue text-gray font-weight-500">Tugas pelatihan</span>
                    </div>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/58.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5"><?php echo e($pendingReviewCount); ?></strong>
                        <span class="font-16 text-dark-blue text-gray font-weight-500">Belum ditinjau</span>
                    </div>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/45.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($passedCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Lulus</span>
                    </div>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/pin.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($failedCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Gagal</span>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Tugas peserta pelatihan</h2>
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
                                    <th class="text-center">Minimal nilai</th>
                                    <th class="text-center">Rata-rata</th>
                                    <th class="text-center">Penyerahan</th>
                                    <th class="text-center">Tertunda</th>
                                    <th class="text-center">Lulus</th>
                                    <th class="text-center">Gagal</th>
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
                                            <span class="font-weight-500"><?php echo e($assignment->min_grade ?? '-'); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e($assignment->average_grade ?? '-'); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e($assignment->submissions); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e($assignment->pendingCount); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span><?php echo e($assignment->passedCount); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span><?php echo e($assignment->failedCount); ?></span>
                                        </td>

                                        <td class="align-middle">
                                            <?php switch($assignment->status):
                                                case ('active'): ?>
                                                <span class="text-dark-blue font-weight-500">Aktif</span>
                                                <?php break; ?>
                                                <?php case ('inactive'): ?>
                                                <span class="text-danger font-weight-500">Tidak aktif</span>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>


                                        <td class="align-middle text-right">

                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>

                                                <div class="dropdown-menu menu-lg">
                                                    <a href="/panel/assignments/<?php echo e($assignment->id); ?>/students?status=pending" target="_blank"
                                                       class="webinar-actions d-block mt-10 font-weight-normal">Belum ditinjau</a>

                                                    <a href="/panel/assignments/<?php echo e($assignment->id); ?>/students" target="_blank"
                                                       class="webinar-actions d-block mt-10 font-weight-normal">Semua Tugas</a>
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
                'title' => ('Tidak ada tugas'),
                'hint' => nl2br(('Tugas peserta pelatihan akan muncul di sini.')),
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/assignments/my-courses-assignments.blade.php ENDPATH**/ ?>