<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <div class="flex-grow-1">
                <h2 class="font-20 font-weight-bold"><?php echo e($topic->title); ?></h2>

                <span class="d-block font-14 font-weight-500 text-gray mt-1">Oleh <span class="font-weight-bold"><?php echo e($topic->creator->full_name); ?></span> Pada <?php echo e(dateTimeFormat($topic->created_at, 'j M Y | H:i')); ?></span>
            </div>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="/admin/forums">Forum</a></div>
                <div class="breadcrumb-item"><a href="/admin/forums/<?php echo e($topic->forum_id); ?>/topics">Topik</a></div>
                <div class="breadcrumb-item">Post</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 ">

                    <div class="card">
                        <div class="card-body">

                            <?php echo $__env->make('admin.forums.topics.post_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            
                            <?php if(!empty($topic->posts) and count($topic->posts)): ?>
                                <?php $__currentLoopData = $topic->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('admin.forums.topics.post_card',['post' => $postRow], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <div class="mt-4">
                                <h3 class="font-16 font-weight-bold text-dark">Balas ke topik</h3>

                                <div class="p-2 rounded-lg border bg-white mt-2">
                                    <form action="/admin/forums/<?php echo e($topic->forum_id); ?>/topics/<?php echo e($topic->id); ?>/posts" method="post">
                                        <?php echo e(csrf_field()); ?>


                                        <div class="topic-posts-reply-card d-none position-relative px-2 py-2 rounded-sm bg-info-light mb-2">
                                            <input type="hidden" name="reply_post_id" class="js-reply-post-id">
                                            <div class="js-reply-post-title font-14 font-weight-500 text-gray">Anda membalas pesan <span></span></div>
                                            <div class="js-reply-post-description mt-1 font-14 text-gray"></div>

                                            <button type="button" class="js-close-reply-post btn-transparent">
                                                <i class="fa fa-times"></i>
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
                                                        <div class="input-group mr-2">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="input-group-text admin-file-manager" data-input="postAttachmentInput" data-preview="holder">
                                                                    <i class="fa fa-upload"></i>
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


                            <div class="mt-4">
                                <h3 class="font-16 font-weight-bold">Tindakan untuk topik</h3>

                                <div class=" mt-2">
                                    <form action="/admin/forums/<?php echo e($topic->forum_id); ?>/topics/<?php echo e($topic->id); ?>/closeToggle" method="post">
                                        <?php echo e(csrf_field()); ?>


                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="form-group custom-switches-stacked">
                                                    <label class="custom-switch pl-0 d-flex align-items-center">
                                                        <input type="hidden" name="close" value="0">
                                                        <input type="checkbox" name="close" id="forumCloseSwitch" value="1" <?php echo e((!empty($topic) and $topic->close) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                                                        <span class="custom-switch-indicator"></span>
                                                        <label class="custom-switch-description mb-0 cursor-pointer" for="forumCloseSwitch">Tutup diskusi topik</label>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var replyToTopicSuccessfullySubmittedLang = '<?php echo e(('Balas ke topik berhasil dikirimkan')); ?>'
        var reportSuccessfullySubmittedLang = '<?php echo e(('Laporan berhasil dikirim')); ?>';
        var changesSavedSuccessfullyLang = '<?php echo e(('Perubahan berhasil disimpan.')); ?>';
        var oopsLang = '<?php echo e(('Oops...')); ?>';
        var somethingWentWrongLang = '<?php echo e(('Ada yang salah...')); ?>';
        var reportLang = '<?php echo e(('Laporkan')); ?>';
        var descriptionLang = '<?php echo e(('Deskripsi')); ?>';
        var editAttachmentLabelLang = '<?php echo e(('Lampirkan file')); ?> (<?php echo e(('Opsional')); ?>)';
        var sendLang = '<?php echo e(('Kirim')); ?>';
        var notLoginToastTitleLang = '<?php echo e(('Konten yang Dibatasi')); ?>';
        var notLoginToastMsgLang = '<?php echo e(('Silakan masuk untuk mengakses konten.')); ?>';
        var topicBookmarkedSuccessfullyLang = '<?php echo e(('Topik berhasil dibookmark')); ?>';
        var topicUnBookmarkedSuccessfullyLang = '<?php echo e(('Topik dihapus dari bookmark')); ?>';
        var editPostLang = '<?php echo e(('Edit post')); ?>';
    </script>

    <script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="/assets/default/js/parts/topic_posts.min.js"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/forums/topics/posts.blade.php ENDPATH**/ ?>