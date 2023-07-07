<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/learning_page/styles.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/video/video-js.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="learning-page">

        <?php echo $__env->make('web.default.course.learningPage.components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="d-flex position-relative">
            <div class="learning-page-content flex-grow-1 bg-info-light p-15">
                <?php echo $__env->make('web.default.course.learningPage.components.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="learning-page-tabs show">
                <ul class="nav nav-tabs py-15 d-flex align-items-center justify-content-around" id="tabs-tab" role="tablist">
                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center active" id="content-tab"
                           data-toggle="tab" href="#content" role="tab" aria-controls="content"
                           aria-selected="true">
                            <i class="learning-page-tabs-icons mr-5">
                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </i>
                            <span class="learning-page-tabs-link-text">Materi</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="quizzes-tab" data-toggle="tab"
                           href="#quizzes" role="tab" aria-controls="quizzes"
                           aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </i>
                            <span class="learning-page-tabs-link-text">Kuis</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="certificates-tab" data-toggle="tab"
                           href="#certificates" role="tab" aria-controls="certificates"
                           aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.certificate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </i>
                            <span class="learning-page-tabs-link-text">Sertifikat</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content h-100" id="nav-tabContent">
                    <div class="pb-20 tab-pane fade show active h-100" id="content" role="tabpanel"
                         aria-labelledby="content-tab">
                        <?php echo $__env->make('web.default.course.learningPage.components.content_tab.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="pb-20 tab-pane fade  h-100" id="quizzes" role="tabpanel"
                         aria-labelledby="quizzes-tab">
                        <?php echo $__env->make('web.default.course.learningPage.components.quiz_tab.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="pb-20 tab-pane fade  h-100" id="certificates" role="tabpanel"
                         aria-labelledby="certificates-tab">
                        <?php echo $__env->make('web.default.course.learningPage.components.certificate_tab.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/video/video.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/video/youtube.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/video/vimeo.js"></script>

    <script>
        var defaultItemType = '<?php echo e(request()->get('type')); ?>'
        var defaultItemId = '<?php echo e(request()->get('item')); ?>'
        var loadFirstContent = <?php echo e((!empty($dontAllowLoadFirstContent) and $dontAllowLoadFirstContent) ? 'false' : 'true'); ?>; // allow to load first content when request item is empty

        var courseUrl = "<?php echo e(url($course->getUrl())); ?>";

        // lang
        var pleaseWaitForTheContentLang = '<?php echo e(('Harap tunggu hingga konten materi dimuat')); ?>';
        var downloadTheFileLang = '<?php echo e(('Unduh file')); ?>';
        var downloadLang = '<?php echo e(('Unduh')); ?>';
        var showHtmlFileLang = '<?php echo e(('Play Pelatihan SCORM')); ?>';
        var showLang = '<?php echo e(('Lihat')); ?>';
        var sessionIsLiveLang = '<?php echo e(('Sesi siaran langsung!')); ?>';
        var youCanJoinTheLiveNowLang = '<?php echo e(('Anda dapat bergabung dengan siaran langsung sekarang ...')); ?>';
        var joinTheClassLang = '<?php echo e(('Bergabung dengan kelas')); ?>';
        var coursePageLang = '<?php echo e(('Halaman pelatihan')); ?>';
        var quizPageLang = '<?php echo e(('Halaman kuis')); ?>';
        var sessionIsNotStartedYetLang = '<?php echo e(('Sesi belum dimulai')); ?>';
        var thisSessionWillBeStartedOnLang = '<?php echo e(('Sesi ini akan dimulai')); ?>';
        var sessionIsFinishedLang = '<?php echo e(('Sesi telah selesai')); ?>';
        var sessionIsFinishedHintLang = '<?php echo e(('Sesi ini telah selesai. Anda tidak dapat bergabung dengannya.')); ?>';
        var goToTheQuizPageForMoreInformationLang = '<?php echo e(('Buka halaman kuis untuk informasi lebih lanjut')); ?>';
        var downloadCertificateLang = '<?php echo e(('Unduh sertifikat')); ?>';
        var enjoySharingYourCertificateWithOthersLang = '<?php echo e(('Nikmati berbagi sertifikat Anda dengan orang lain...')); ?>';
        var attachmentsLang = '<?php echo e(('Lampiran file')); ?>';
        var checkAgainLang = '<?php echo e(('Periksa lagi')); ?>';
        var learningToggleLangSuccess = '<?php echo e(('Status pembelajaran Anda berhasil diubah.')); ?>';
        var learningToggleLangError = '<?php echo e(('Gagal mengubah status pembelajaran.')); ?>';
        var sequenceContentErrorModalTitle = '<?php echo e(('Akses ditolak!')); ?>';
        var sendAssignmentSuccessLang = '<?php echo e(('Berhasil dikirim')); ?>';
        var saveAssignmentRateSuccessLang = '<?php echo e(('Nilai tugas berhasil disimpan')); ?>';
        var saveSuccessLang = '<?php echo e(('Item berhasil ditambahkan.')); ?>';
        var changesSavedSuccessfullyLang = '<?php echo e(('Perubahan berhasil disimpan.')); ?>';
        var oopsLang = '<?php echo e(('Oops...')); ?>';
        var somethingWentWrongLang = '<?php echo e(('Ada yang salah...')); ?>';
        var notAccessToastTitleLang = '<?php echo e(('Akses ditolak!')); ?>';
        var notAccessToastMsgLang = '<?php echo e(('Anda tidak memiliki akses ke konten materi ini.')); ?>';
        var cantStartQuizToastTitleLang = '<?php echo e(('Permintaan gagal')); ?>';
        var cantStartQuizToastMsgLang = '<?php echo e(('Anda tidak dapat memulai kuis ini.')); ?>';
        var learningPageEmptyContentTitleLang = '<?php echo e(('Tidak ada isi konten materi!')); ?>';
        var learningPageEmptyContentHintLang = '<?php echo e(('Pelatihan ini tidak menyertakan konten materi apa pun')); ?>';
    </script>
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="v5gxvm7qj1ku9la"></script>
    <script src="<?php echo e(asset('')); ?>vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/video_player_helpers.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/learning_page/scripts.min.js"></script>

    <?php if((!empty($isForumPage) and $isForumPage) or (!empty($isForumAnswersPage) and $isForumAnswersPage)): ?>
        <script src="<?php echo e(asset('')); ?>assets/learning_page/forum.min.js"></script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.default.layouts.app',['appFooter' => false, 'appHeader' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/course/learningPage/index.blade.php ENDPATH**/ ?>