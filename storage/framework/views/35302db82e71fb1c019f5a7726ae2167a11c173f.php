<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item"><?php echo e($pageTitle); ?></div>
            </div>
        </div>

        <div class="section-body">
            <?php
                $unreadNotificationsIds = [];
                if(!empty($unreadNotifications) and count($unreadNotifications)) {
                    $unreadNotificationsIds=$unreadNotifications->pluck('id')->toArray();
                }
            ?>

            <div class="card">
                <div class="card-header">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_send')): ?>
                        <div class="text-right">
                            <a href="/admin/notifications/send" class="btn btn-primary">Kirim notifikasi</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped font-14" id="datatable-basic">

                            <tr>
                                <th class="text-left">Judul</th>
                                <th class="text-center">Pengirim</th>
                                <th class="text-center">Pesan</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>

                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($notification->title); ?></td>
                                    <td class="text-center"><?php echo e($notification->sender); ?></td>
                                    <td class="text-center">
                                        <button type="button" data-item-id="<?php echo e($notification->id); ?>" class="js-show-description btn btn-outline-primary">Lihat</button>
                                        <input type="hidden" value="<?php echo e(nl2br($notification->message)); ?>">
                                    </td>
                                    <td class="text-center"><?php echo e($notification->type); ?></td>
                                    <td class="text-center">
                                        <?php if(in_array($notification->id,$unreadNotificationsIds)): ?>
                                            <span class="text-danger">
                                                Belum dibaca</span>
                                        <?php else: ?>
                                            <span class="text-success">Dibaca</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?php echo e(dateTimeFormat($notification->created_at,'j M Y | H:i')); ?></td>

                                    <td width="100">

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_delete')): ?>
                                            <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/notifications/'. $notification->id.'/delete','btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <?php echo e($notifications->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="notificationMessageModal" tabindex="-1" aria-labelledby="notificationMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationMessageLabel">Pesan Kontak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/js/admin/notifications.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/notifications/lists.blade.php ENDPATH**/ ?>