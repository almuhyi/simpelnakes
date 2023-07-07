<section class="p-15 m-15 border rounded-lg">
    <div class="course-forum-top-stats d-flex flex-wrap flex-md-nowrap align-items-center justify-content-around">
        <div class="d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/47.svg" class="course-forum-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($questionsCount); ?></strong>
                <span class="font-14 text-gray font-weight-500">Pertanyaan</span>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/120.svg" class="course-forum-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($resolvedCount); ?></strong>
                <span class="font-14 text-gray font-weight-500">Terselesaikan</span>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/119.svg" class="course-forum-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($openQuestionsCount); ?></strong>
                <span class="font-14 text-gray font-weight-500">Pertanyaan terbuka</span>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/39.svg" class="course-forum-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($commentsCount); ?></strong>
                <span class="font-14 text-gray font-weight-500">Jawaban</span>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-center pb-5 pb-md-0">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo e(asset('')); ?>assets/default/img/activity/49.svg" class="course-forum-top-stats__icon" alt="">
                <strong class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($activeUsersCount); ?></strong>
                <span class="font-14 text-gray font-weight-500">Pengguna Aktif</span>
            </div>
        </div>
    </div>

    <div class="container-fluid p-15 rounded-lg bg-info-light font-14 text-gray mt-20">
        <div class="row align-items-center">
            <div class="col-12 col-lg-4">
                <div class="">
                    <h3 class="font-16 font-weight-bold text-dark-blue">Forum pelatihan</h3>
                    <span class="d-block font-14 font-weight-500 text-gray mt-1">Komunikasikan dengan orang lain dan ajukan pertanyaan Anda!</span>
                </div>
            </div>
            <div class="col-12 col-lg-5 mt-15 mt-lg-0">
                <form action="<?php echo e(url(request()->url())); ?>" method="get">
                    <div class="d-flex align-items-center">
                        <input type="text" name="search" class="form-control flex-grow-1" value="<?php echo e(request()->get('search')); ?>" placeholder="cari di forum ini">
                        <button type="submit" class="btn btn-primary btn-sm ml-10 course-forum-search-btn">
                            <i data-feather="search" class="text-white" width="16" height="16"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-3 mt-15 mt-lg-0 text-right">
                <button type="button" id="askNewQuestion" class="btn btn-primary btn-sm course-forum-search-btn">
                    <i data-feather="file" class="text-white" width="16" height="16"></i>
                    <span class="ml-1">Buat baru</span>
                </button>
            </div>
        </div>
    </div>
</section>

<?php if($forums and count($forums)): ?>
    <?php $__currentLoopData = $forums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="course-forum-question-card p-15 m-15 border rounded-lg">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="d-flex align-items-start">
                        <div class="question-user-avatar">
                            <img src="<?php echo e(asset($forum->user->getAvatar(64))); ?>" class="img-cover rounded-circle" alt="<?php echo e($forum->user->full_name); ?>">
                        </div>
                        <div class="ml-10">
                            <a href="<?php echo e(url($course->getForumPageUrl())); ?>/<?php echo e($forum->id); ?>/answers" class="">
                                <h4 class="font-16 font-weight-bold text-dark-blue"><?php echo e($forum->title); ?></h4>
                            </a>

                            <span class="d-block font-12 text-gray mt-5">Oleh <?php echo e($forum->user->full_name); ?> Pada <?php echo e(dateTimeFormat($forum->created_at, 'j M Y | H:i')); ?></span>

                            <p class="d-block font-14 text-gray mt-10"><?php echo nl2br($forum->description); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-15 mt-lg-0 border-left">
                    <?php if($course->isOwner($user->id)): ?>
                        <button type="button" data-action="<?php echo e(url($course->getForumPageUrl())); ?>/<?php echo e($forum->id); ?>/pinToggle" class="question-forum-pin-btn d-flex align-items-center justify-content-center">
                            <img src="<?php echo e(asset('')); ?>assets/default/img/learning/<?php echo e($forum->pin ? 'un_pin' : 'pin'); ?>.svg" alt="pin icon" class="">
                        </button>
                    <?php endif; ?>


                    <?php if(!empty($forum->answers) and count($forum->answers)): ?>
                        <div class="py-15 row">
                            <div class="col-3">
                                <span class="d-block font-12 text-gray">Jawaban</span>
                                <span class="d-block font-14 text-dark mt-10"><?php echo e($forum->answer_count); ?></span>
                            </div>

                            <div class="col-3">
                                <span class="d-block font-12 text-gray">Pengguna</span>
                                <div class="answers-user-icons d-flex align-items-center">
                                    <?php if(!empty($forum->usersAvatars)): ?>
                                        <?php $__currentLoopData = $forum->usersAvatars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userAvatar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="user-avatar-card rounded-circle">
                                                <img src="<?php echo e(asset($userAvatar->getAvatar(32))); ?>" class="img-cover rounded-circle" alt="<?php echo e($userAvatar->full_name); ?>">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <?php if(($forum->answers->groupBy('user_id')->count() - count($forum->usersAvatars)) > 0): ?>
                                        <span class="answer-count d-flex align-items-center justify-content-center font-12 text-gray rounded-circle">+<?php echo e($forum->answer_count - count($forum->usersAvatars)); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-6 position-relative">
                                <span class="d-block font-12 text-gray">Aktivitas terakhir</span>
                                <span class="d-block font-14 text-dark mt-10"><?php echo e(dateTimeFormat($forum->lastAnswer->created_at,'j M Y | H:i')); ?></span>
                            </div>
                        </div>

                        <div class="py-15 border-top position-relative">
                            <span class="d-block font-12 text-gray">Jawaban Terakhir</span>
                            <div class="d-flex align-items-start mt-20">
                                <div class="last-answer-user-avatar">
                                    <img src="<?php echo e(asset($forum->lastAnswer->user->getAvatar(30))); ?>" class="img-cover rounded-circle" alt="<?php echo e($forum->lastAnswer->user->full_name); ?>">
                                </div>
                                <div class="ml-10">
                                    <h4 class="font-14 text-dark font-weight-bold"><?php echo e($forum->lastAnswer->user->full_name); ?></h4>
                                    <p class="font-12 font-weight-500 text-gray mt-5"><?php echo truncate($forum->lastAnswer->description, 160); ?></p>
                                </div>
                            </div>

                            <?php if(!empty($forum->resolved)): ?>
                                <div class="resolved-answer-badge d-flex align-items-center font-12 text-primary">
                            <span class="badge-icon d-flex align-items-center justify-content-center">
                                <i data-feather="check" width="20" height="20"></i>
                            </span>Terselesaikan
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="d-flex flex-column justify-content-center text-center py-15 h-100">
                            <p class="text-gray font-14 font-weight-bold">Jadilah orang pertama yang menjawab pertanyaan ini.</p>
                            <div class="">
                                <a href="<?php echo e(url($course->getForumPageUrl())); ?>/<?php echo e($forum->id); ?>/answers" class="btn btn-primary btn-sm mt-15">Jawab</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="learning-page-forum-empty d-flex align-items-center justify-content-center flex-column">
        <div class="learning-page-forum-empty-icon d-flex align-items-center justify-content-center">
            <img src="<?php echo e(asset('')); ?>assets/default/img/learning/forum-empty.svg" class="img-fluid" alt="">
        </div>

        <div class="d-flex align-items-center flex-column mt-10 text-center">
            <h3 class="font-20 font-weight-bold text-dark-blue text-center"></h3>
            <p class="font-14 font-weight-500 text-gray mt-5 text-center">Tidak ada topik forum pelatihan!</p>
        </div>
    </div>
<?php endif; ?>

<?php echo $__env->make('web.default.course.learningPage.components.forum.ask_question_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/course/learningPage/components/forum/forum.blade.php ENDPATH**/ ?>