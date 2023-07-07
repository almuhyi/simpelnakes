<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/vendors/summernote/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-35 mt-md-50">
        <section class="d-flex align-items-center justify-content-between px-15 px-md-30 py-15 py-md-25 border rounded-lg">
            <div class="flex-grow-1">
                <h2 class="font-20 font-weight-bold text-secondary"><?php echo e($topic->title); ?></h2>
                <span class="d-block font-14 font-weight-500 text-gray mt-5">Oleh <span class="font-weight-bold"><?php echo e($topic->creator->full_name); ?></span> Pada <?php echo e(dateTimeFormat($topic->created_at, 'j M Y | H:i')); ?></span>
                <div class="mt-15 ">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 m-0">
                            <li class="breadcrumb-item font-12 text-gray"><a href="<?php echo e(url('/')); ?>"><?php echo e(getGeneralSettings('site_name')); ?></a></li>
                            <li class="breadcrumb-item font-12 text-gray"><a href="<?php echo e(url('/forums')); ?>">Forum</a></li>
                            <li class="breadcrumb-item font-12 text-gray"><a href="<?php echo e(url($topic->forum->getUrl())); ?>"><?php echo e($topic->forum->title); ?></a></li>
                            <li class="breadcrumb-item font-12 text-gray font-weight-bold" aria-current="page"><?php echo e($topic->title); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <button type="button" data-action="<?php echo e(url($topic->getBookmarkUrl())); ?>" class="<?php echo e(!empty($authUser) ? 'js-topic-bookmark' : 'login-to-access'); ?> d-flex align-items-center flex-column btn-transparent <?php echo e($topic->bookmarked ? 'text-warning' : ''); ?>">
                <i data-feather="bookmark" class="text-gray" width="22" height="22"></i>
                <span class="font-12 mt-5 text-gray">Bookmark</span>
            </button>
        </section>

        <?php echo $__env->make('web.default.forum.post_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <?php if(!empty($topic->posts) and count($topic->posts)): ?>
            <?php $__currentLoopData = $topic->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.default.forum.post_card',['post' => $postRow], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        
        <?php if(!auth()->check()): ?>
            <div class="reply-login-close-card d-flex flex-column align-items-center w-100 p-15 rounded-lg border bg-white mt-15 p-40">
                <div class="icon-card">
                    <img src="<?php echo e(asset('')); ?>assets/default/img/topics/login.svg" alt="login icon" class="img-cover">
                </div>

                <h4 class="font-20 font-weight-bold text-secondary">Masuk untuk membalas</h4>
                <p class="font-14 font-weight-500 text-gray mt-5">Harap masuk untuk membalas topik ini.</p>
            </div>
        <?php elseif($topic->close or $forum->close): ?>
            <div class="reply-login-close-card d-flex flex-column align-items-center w-100 p-15 rounded-lg border bg-white mt-15 p-40">
                <div class="icon-card">
                    <img src="<?php echo e(asset('')); ?>assets/default/img/topics/closed.svg" alt="closed icon" class="img-cover">
                </div>

                <h4 class="font-20 font-weight-bold text-secondary">Topik tertutup</h4>
                <p class="font-14 font-weight-500 text-gray mt-5">Anda tidak dapat membalas topik tertutup</p>
            </div>
        <?php else: ?>
            <div class="mt-30">
                <h3 class="font-16 font-weight-bold text-secondary">Balas ke topik</h3>
                <div class="p-15 rounded-lg border bg-white mt-15">
                    <form action="<?php echo e(url($topic->getPostsUrl())); ?>" method="post">
                        <?php echo e(csrf_field()); ?>


                        <div class="topic-posts-reply-card d-none position-relative px-20 py-15 rounded-sm bg-info-light mb-15">
                            <input type="hidden" name="reply_post_id" class="js-reply-post-id">
                            <div class="js-reply-post-title font-14 font-weight-500 text-gray">Anda membalas kepada <span></span></div>
                            <div class="js-reply-post-description mt-5 font-14 text-gray"></div>

                            <button type="button" class="js-close-reply-post btn-transparent">
                                <i data-feather="x" width="22" height="22"></i>
                            </button>
                        </div>


                        <div class="form-group">
                            <label class="input-label">Deskripsi</label>
                            <textarea id="summernote" name="description" class="form-control"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">

                                <div class="form-group">
                                    <label class="input-label">Lampirkan file (Opsional)</label>

                                    <div class="d-flex align-items-center">
                                        <div class="input-group mr-10">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text panel-file-manager" data-input="postAttachmentInput" data-preview="holder">
                                                    <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="attach" id="postAttachmentInput" value="" class="form-control" placeholder="Pilih lampiran"/>
                                        </div>

                                        <button type="button" class="js-save-post btn btn-primary btn-sm">Kirim</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <div id="topicReportModal" class="d-none">
        <h3 class="section-title after-line font-20 text-dark-blue">Laporkan</h3>

        <form action="<?php echo e(url($topic->getPostsUrl())); ?>/report" method="post" class="mt-25">
            <input type="hidden" name="item_id" class="js-item-id-input"/>
            <input type="hidden" name="item_type" class="js-item-type-input"/>

            <div class="form-group">
                <label class="text-dark-blue font-14" for="message_to_reviewer">Pesan untuk pengulas</label>
                <textarea name="message" id="message_to_reviewer" class="form-control" rows="10"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <p class="text-gray font-16">Tolong jelaskan tentang laporan secara singkat dan jelas.</p>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-topic-report-submit btn btn-sm btn-primary">Laporkan</button>
                <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutup</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var replyToTopicSuccessfullySubmittedLang = '<?php echo e(('Balas ke topik berhasil dikirimkan')); ?>'
        var reportSuccessfullySubmittedLang = '<?php echo e(('Laporan berhasil dikirim')); ?>';
        var changesSavedSuccessfullyLang = '<?php echo e(('Perubahan berhasil disimpan.')); ?>';
        var oopsLang = '<?php echo e(('oopsss.....')); ?>';
        var somethingWentWrongLang = '<?php echo e(('Ada yang salah...')); ?>';
        var reportLang = '<?php echo e(('Laporkan')); ?>';
        var descriptionLang = '<?php echo e(('Deksripsi')); ?>';
        var editAttachmentLabelLang = '<?php echo e(('Lampirkan file')); ?> (<?php echo e(('Opsional')); ?>)';
        var sendLang = '<?php echo e(('Kirim')); ?>';
        var notLoginToastTitleLang = '<?php echo e(('Materi yang Dibatasi')); ?>';
        var notLoginToastMsgLang = '<?php echo e(('Silahkan masuk untuk mengakses materi.')); ?>';
        var topicBookmarkedSuccessfullyLang = '<?php echo e(('Topik berhasil di-bookmark')); ?>';
        var topicUnBookmarkedSuccessfullyLang = '<?php echo e(('Topik dihapus dari bookmark')); ?>';
        var editPostLang = '<?php echo e(('Edit post')); ?>';
    </script>

    <script src="<?php echo e(asset('')); ?>assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/topic_posts.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/forum/posts.blade.php ENDPATH**/ ?>