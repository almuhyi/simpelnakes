<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title">Statistik komentar</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/39.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5"><?php echo e($comments->count()); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Komentar</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/41.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5"><?php echo e($repliedCommentsCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Balasan</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/40.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5"><?php echo e(($comments->count() - $repliedCommentsCount)); ?></strong>
                        <span class="font-16 text-gray font-weight-500">
                            Tidak di balas</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <h2 class="section-title">Filter komentar</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="<?php echo e(url('/panel/webinars/comments')); ?>" method="get" class="row">
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
                                    <input type="text" name="from" autocomplete="off" value="<?php echo e(request()->get('from')); ?>" class="form-control <?php echo e(!empty(request()->get('from')) ? 'datepicker' : 'datefilter'); ?>" aria-describedby="dateInputGroupPrepend"/>
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
                                    <input type="text" name="to" autocomplete="off" value="<?php echo e(request()->get('to')); ?>" class="form-control <?php echo e(!empty(request()->get('to')) ? 'datepicker' : 'datefilter'); ?>" aria-describedby="dateInputGroupPrepend"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="form-group">
                                <label class="input-label">Pengguna</label>
                                <input type="text" name="user" value="<?php echo e(request()->get('user')); ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="form-group">
                                <label class="input-label">Pelatihan</label>
                                <input type="text" name="webinar" value="<?php echo e(request()->get('webinar')); ?>" class="form-control"/>
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
            <h2 class="section-title">Daftar komentar pelatihan</h2>
        </div>

        <?php if(!empty($comments) and !$comments->isEmpty()): ?>

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table text-center ">
                                <thead>
                                <tr>
                                    <th class="text-left">Pengguna</th>
                                    <th class="text-left">Pelatihan</th>
                                    <th class="text-center">Komentar</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th class="text-left">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="<?php echo e(asset($comment->user->getAvatar())); ?>" class="img-cover" alt="">
                                                </div>
                                                <span class="user-name ml-5 text-dark-blue font-weight-500"><?php echo e($comment->user->full_name); ?></span>
                                            </div>
                                        </th>
                                        <td class=" text-left align-middle" width="35%">
                                            <a href="<?php echo e(url($comment->webinar->getUrl())); ?>" target="_blank" class="text-dark-blue font-weight-500"><?php echo e($comment->webinar->title); ?></a>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" data-comment-id="<?php echo e($comment->id); ?>" class="js-view-comment btn btn-sm btn-gray200">Lihat</button>
                                        </td>
                                        <td class="align-middle">
                                            <?php if(empty($comment->reply_id)): ?>
                                                <span class="text-primary font-weight-500">Komentar awal</span>
                                            <?php else: ?>
                                                <span class="text-dark-blue font-weight-500">Balasan</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle"><?php echo e(dateTimeFormat($comment->created_at,'j M Y | H:i')); ?></td>
                                        <td class="align-middle text-right">
                                            <input type="hidden" id="commentDescription<?php echo e($comment->id); ?>" value="<?php echo nl2br($comment->comment); ?>">
                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" data-comment-id="<?php echo e($comment->id); ?>" class="js-reply-comment btn-transparent">Balas</button>
                                                    <button type="button" data-item-id="<?php echo e($comment->webinar_id); ?>" data-comment-id="<?php echo e($comment->id); ?>" class="btn-transparent webinar-actions d-block mt-10 text-hover-primary report-comment">Laporkan</button>
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

        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                'file_name' => 'comment.png',
                'title' => 'Anda tidak memiliki komentar!',
                'hint' =>  nl2br('Ketika pengguna atau peserta mengomentari pelatihan Anda itu akan muncul dalam daftar ini.') ,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>

    <div class="my-30">
        <?php echo e($comments->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/moment.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var commentLang = '<?php echo e(('Komentar')); ?>';
        var replyToCommentLang = '<?php echo e(('Balas komentar')); ?>';
        var saveLang = '<?php echo e(('Simpan')); ?>';
        var closeLang = '<?php echo e(('Tutup')); ?>';
        var reportLang = '<?php echo e(('Laporkan')); ?>';
        var reportSuccessLang = '<?php echo e(('Laporkan berhasil!')); ?>';
        var messageToReviewerLang = '<?php echo e(('Pesan untuk peninjau')); ?>';
    </script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/comments.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/comments.blade.php ENDPATH**/ ?>