<section class="p-15 m-15 border rounded-lg">
    <div class="assignment-top-stats d-flex flex-wrap flex-md-nowrap align-items-center justify-content-around">
        <div class="assignment-top-stats__item d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/calendar.svg" class="assignment-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5">
                    <?php if($assignmentDeadline): ?>
                        <?php echo e(is_bool($assignmentDeadline) ? ('Tak terbatas') : ceil($assignmentDeadline)); ?> Hari
                    <?php else: ?>
                        <span class="text-danger">Kadaluwarsa</span>
                    <?php endif; ?>
                </strong>
                <span class="font-14 text-gray font-weight-500">Tenggat waktu</span>
            </div>
        </div>

        <div class="assignment-top-stats__item d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/homework.svg" class="assignment-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5">
                    <?php if(!empty($assignment->attempts)): ?>
                        <?php echo e($submissionTimes); ?>/<?php echo e($assignment->attempts); ?>

                    <?php else: ?>
                        Tak terbatas
                    <?php endif; ?>
                </strong>
                <span class="font-14 text-gray font-weight-500">Batas Pengajuan</span>
            </div>
        </div>

        <div class="assignment-top-stats__item d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/45.svg" class="assignment-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($assignmentHistory->grade ?? 0); ?>/<?php echo e($assignment->grade); ?></strong>
                <span class="font-14 text-gray font-weight-500">nilai Anda</span>
            </div>
        </div>

        <div class="assignment-top-stats__item d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/58.svg" class="assignment-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($assignment->pass_grade); ?></strong>
                <span class="font-14 text-gray font-weight-500">Minimal nilai</span>
            </div>
        </div>

        <div class="assignment-top-stats__item d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/88.svg" class="assignment-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($assignmentHistory->status); ?></strong>
                <span class="font-14 text-gray font-weight-500">Status</span>
            </div>
        </div>
    </div>

    <div class="p-15 rounded-lg bg-info-light font-14 text-gray mt-20"><?php echo $assignment->description; ?></div>
</section>

<?php if(!empty($assignment->attachments) and count($assignment->attachments)): ?>
    <section class="mt-25 container-fluid">
        <h2 class="section-title">Lampiran file</h2>

        <div class="row">
            <?php $__currentLoopData = $assignment->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-lg-3 mt-10">
                    <a href="<?php echo e(url($attachment->getDownloadUrl())); ?>" target="_blank" class="d-flex align-items-center p-10 border rounded-sm">
                        <span class="chapter-icon bg-gray300 mr-10">
                            <i data-feather="file" class="text-gray" width="16" height="16"></i>
                        </span>

                        <div class="">
                            <h4 class="font-12 text-gray font-weight-bold"><?php echo e($attachment->title); ?></h4>
                            <span class="font-12 text-gray"><?php echo e($attachment->getFileSize()); ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php endif; ?>

<section class="mt-25 container-fluid">
    <h2 class="section-title">Riwayat Tugas</h2>

    <section class=" p-10 my-10 border rounded-lg">
        <div class="row">
            <div class="col-12 col-lg-4">
                <?php if(
                    $user->id != $assignment->creator_id and
                    (
                        $assignmentHistory->status == \App\Models\WebinarAssignmentHistory::$passed or
                        $assignmentHistory->status == \App\Models\WebinarAssignmentHistory::$notPassed or
                        !$assignmentDeadline or
                        (
                            !$checkHasAttempts and !empty($assignment->attempts) and $submissionTimes >= $assignment->attempts
                        )
                    )
                ): ?>
                    <div class="d-flex align-items-center justify-content-center flex-column bg-info-light p-10 rounded-sm border h-100">
                        <div class="learning-page-assignment-history-status-icon d-flex align-items-center justify-content-center">
                            <?php if($assignmentHistory->status == \App\Models\WebinarAssignmentHistory::$passed): ?>
                                <img src="<?php echo e(asset('')); ?>assets/default/img/learning/assignment_passed.svg" class="img-fluid" alt="">
                            <?php elseif($assignmentHistory->status == \App\Models\WebinarAssignmentHistory::$notPassed): ?>
                                <img src="<?php echo e(asset('')); ?>assets/default/img/learning/no_assignment.svg" class="img-fluid" alt="">
                            <?php else: ?>
                                <img src="<?php echo e(asset('')); ?>assets/default/img/learning/assignment_pending.svg" class="img-fluid" alt="">
                            <?php endif; ?>
                        </div>

                        <div class="d-flex align-items-center flex-column mt-10 text-center">
                            <?php if($assignmentHistory->status == \App\Models\WebinarAssignmentHistory::$passed): ?>
                                <h3 class="font-20 font-weight-bold text-dark-blue text-center">Tugas Lulus!</h3>
                                <p class="mt-5 text-gray font-14 text-center">Anda berhasil melewatinya...</p>
                            <?php elseif($assignmentHistory->status == \App\Models\WebinarAssignmentHistory::$notPassed): ?>
                                <h3 class="font-20 font-weight-bold text-dark-blue text-center">Tugas Gagal!</h3>
                                <p class="mt-5 text-gray font-14 text-center">Anda tidak dapat mengirim file ...</p>
                            <?php elseif(!$assignmentDeadline): ?>
                                <h3 class="font-20 font-weight-bold text-dark-blue text-center">Batas Waktu Tercapai!</h3>
                                <p class="mt-5 text-gray font-14 text-center">Anda tidak dapat mengirim file ...</p>
                            <?php else: ?>
                                <h3 class="font-20 font-weight-bold text-dark-blue text-center">Batas pengiriman tugas Tercapai!</h3>
                                <p class="mt-5 text-gray font-14 text-center">Anda tidak dapat mengirim lebih banyak file...}</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="bg-info-light p-10 rounded-sm border">
                        <h4 class="font-16 font-weight-bold text-dark-blue">
                            <?php if($user->id == $assignment->creator_id): ?>
                                Balas percakapan
                            <?php else: ?>
                                Kirim tugas
                            <?php endif; ?>
                        </h4>

                        <form method="post" action="<?php echo e(url('')); ?>/course/assignment/<?php echo e($assignment->id); ?>/history/<?php echo e($assignmentHistory->id); ?>/message">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="assignment_id" value="<?php echo e($assignment->id); ?>">
                            <input type="hidden" name="assignment_history_id" value="<?php echo e($assignmentHistory->id); ?>">
                            <?php if($user->id == $assignment->creator_id): ?>
                                <input type="hidden" name="student_id" value="<?php echo e($assignmentHistory->student_id); ?>">
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="input-label">Deskripsi</label>
                                <textarea rows="6" name="description" class="form-control"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label class="input-label">Judul file (Opsional)</label>
                                <input name="file_title" class="form-control"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label class="input-label">Lampirkan file (Opsional)</label>

                                <div class="d-flex align-items-center">
                                    <div class="input-group mr-10">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text panel-file-manager" data-input="assignmentAttachmentInput" data-preview="holder">
                                                <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="file_path" id="assignmentAttachmentInput" value="" class="form-control" placeholder="Pilih file"/>
                                    </div>

                                    <button type="button" class="js-save-history-message btn btn-primary btn-sm">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if($user->id == $assignment->creator_id): ?>
                        <div class="bg-info-light p-10 rounded-sm border mt-15">
                            <h4 class="font-16 font-weight-bold text-dark-blue">Beri peringkat tugas</h4>

                            <form method="post" action="<?php echo e(url('')); ?>/course/assignment/<?php echo e($assignment->id); ?>/history/<?php echo e($assignmentHistory->id); ?>/setGrade">
                                <input type="hidden" name="student_id" value="<?php echo e($assignmentHistory->student_id); ?>">

                                <div class="form-group">
                                    <label class="input-label">Nilai tugas</label>
                                    <div class="d-flex align-items-start">
                                        <div class="mr-10 w-100">
                                            <input name="grade" class="form-control" placeholder="Nilai lulus: <?php echo e($assignment->pass_grade); ?>"/>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <button type="button" class="js-save-history-rate btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                </div>
                                <p class="font-12 text-gray">
                                    Dengan mengirimkan nilai, tugas akan ditutup.</p>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="col-12 col-lg-8 border-left">

                <div class="h-100">

                    <?php if(!empty($assignmentHistory->messages) and count($assignmentHistory->messages)): ?>
                        <?php $__currentLoopData = $assignmentHistory->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="assignment-attachments-post p-15 border rounded-sm mb-15">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar rounded-circle">
                                        <img src="<?php echo e(asset($message->sender->getAvatar(50))); ?>" class="img-cover rounded-circle" alt="<?php echo e($message->sender->full_name); ?>">
                                    </div>
                                    <div class="ml-10">
                                        <h4 class="font-14 font-weight-500 text-dark-blue"><?php echo e($message->sender->full_name); ?></h4>
                                        <span class="d-block font-12 text-gray"><?php echo e(dateTimeFormat($message->created_at, 'j M Y | H:i')); ?></span>
                                    </div>
                                </div>
                                <div class="mt-15 font-14 text-gray">
                                    <?php echo $message->message; ?>

                                </div>

                                <?php if(!empty($message->file_path)): ?>
                                    <div class="d-flex flex-wrap align-items-center mt-10">
                                        <a href="<?php echo e(url($message->getDownloadUrl($assignment->id))); ?>" target="_blank" class="d-flex align-items-center text-gray bg-info-light border px-10 py-5 rounded-pill mr-10 mt-5">
                                            <i data-feather="paperclip" class="text-gray" width="16" height="16"></i>
                                            <span class="ml-5 font-12 text-gray"><?php echo e(!empty($message->file_title) ? $message->file_title : ('Lampiran')); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center flex-column h-100">
                            <div class="learning-page-assignment-history-status-icon d-flex align-items-center justify-content-center">
                                <img src="<?php echo e(asset('')); ?>assets/default/img/learning/no_assignment.svg" class="img-fluid" alt="">
                            </div>

                            <div class="d-flex align-items-center flex-column mt-10 text-center">
                                <h3 class="font-20 font-weight-bold text-dark-blue text-center">
                                    Belum Ada Tugas yang dikirim!</h3>
                                <p class="mt-5 text-gray font-14 text-center">Kirimkan tugas Anda dan evaluasi kualitas pembelajaran Anda.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</section>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/course/learningPage/components/assignment.blade.php ENDPATH**/ ?>