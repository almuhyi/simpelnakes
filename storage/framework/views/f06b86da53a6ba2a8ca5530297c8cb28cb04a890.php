<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Bookmarks</h2>
        </div>

        <?php if($topics->count() > 0): ?>

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th class="text-left">Topik</th>
                                    <th class="text-center">Forum</th>
                                    <th class="text-center">Balasan</th>
                                    <th class="text-center">Tanggal dipublish</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-left align-middle">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="<?php echo e($topic->creator->getAvatar(48)); ?>" class="img-cover" alt="">
                                                </div>
                                                <a href="<?php echo e($topic->getPostsUrl()); ?>" target="_blank" class="">
                                                    <div class=" ml-5">
                                                        <span class="d-block font-16 font-weight-500 text-dark-blue"><?php echo e($topic->title); ?></span>
                                                        <span class="font-12 text-gray mt-5">Oleh <?php echo e($topic->creator->full_name); ?></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle"><?php echo e($topic->forum->title); ?></td>
                                        <td class="text-center align-middle"><?php echo e($topic->posts_count); ?></td>
                                        <td class="text-center align-middle"><?php echo e(dateTimeFormat($topic->created_at, 'j M Y H:i')); ?></td>
                                        <td class="text-center align-middle">
                                            <a
                                                href="/panel/forums/topics/<?php echo e($topic->id); ?>/removeBookmarks"
                                                data-title="Topik ini akan dihapus dari bookmark Anda"
                                                data-confirm="Konfirmasi"
                                                class="panel-remove-bookmark-btn delete-action d-flex align-items-center justify-content-center p-5 rounded-circle">
                                                <i data-feather="bookmark" width="18" height="18" class="text-danger"></i>
                                            </a>
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
                'title' => ('Tidak ada Bookmark!'),
                'hint' => nl2br(('Anda dapat menjelajahi forum dan menandai topik untuk penggunaan di masa mendatang.')),
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endif; ?>

    </section>

    <div class="my-30">
        <?php echo e($topics->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.default.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/forum/bookmarks.blade.php ENDPATH**/ ?>