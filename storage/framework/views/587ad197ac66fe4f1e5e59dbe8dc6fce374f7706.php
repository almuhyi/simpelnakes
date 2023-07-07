<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Balas ke komentar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Balas ke komentar</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start">
                            <h4>Komentar Utama</h4>
                            <p class="mt-2"><?php echo nl2br($comment->comment); ?></p>

                            <hr class="divider my-2 w-100 border border-gray">

                            <?php if(!empty($comment->replies) and $comment->replies->count() > 0): ?>
                                <div class="mt-1 w-100">
                                    <h4>Daftar balasan</h4>

                                    <div class="table-responsive">
                                        <table class="table table-striped font-14">
                                            <tr>
                                                <th>Pengguna</th>
                                                <th>Komentar</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Jenis</th>
                                                <th>Aksi</th>
                                            </tr>
                                            <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($reply->user->id .' - '.$reply->user->full_name); ?></td>
                                                    <td>
                                                        <button type="button" class="js-show-description btn btn-outline-primary">Lihat</button>
                                                        <input type="hidden" value="<?php echo nl2br($reply->comment); ?>">
                                                    </td>
                                                    <td><?php echo e(dateTimeFormat($reply->created_at, 'Y M j | H:i')); ?></td>
                                                    <td>
                                                        <span class="text-<?php echo e(($reply->status == 'pending') ? 'warning' : 'success'); ?>">
                                                            <?php echo e(($reply->status == 'pending') ? 'Tertunda' : 'Dipublish'); ?>

                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span class="text-<?php echo e((empty($reply->reply_id)) ? 'info' : 'warning'); ?>">
                                                            <?php echo e((empty($reply->reply_id)) ? 'Komentar utama' : 'Balasan'); ?>

                                                        </span>
                                                    </td>

                                                    <td>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_'. $itemRelation .'_comments_status')): ?>
                                                            <a href="/admin/comments/<?php echo e($page); ?>/<?php echo e($reply->id); ?>/toggle" class="btn-transparent text-primary">
                                                                <?php if($reply->status == 'pending'): ?>
                                                                    <i class="fa fa-arrow-up"></i>
                                                                <?php else: ?>
                                                                    <i class="fa fa-arrow-down"></i>
                                                                <?php endif; ?>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_'. $itemRelation .'_comments_edit')): ?>
                                                            <a href="/admin/comments/<?php echo e($page); ?>/<?php echo e($reply->id); ?>/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_'. $itemRelation .'_comments_delete')): ?>
                                                            <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/comments/'. $page .'/'.$reply->id.'/delete','btnClass' => 'btn-sm mt-2'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body ">
                            <form action="/admin/comments/<?php echo e($page); ?>/<?php echo e($comment->id); ?>/reply" method="post">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group mt-15">
                                    <label class="input-label">Balas ke komentar</label>
                                    <textarea id="summernote" name="comment" class="summernote form-control <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo old('comment'); ?></textarea>

                                    <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <button type="submit" class="mt-3 btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="contactMessage" tabindex="-1" aria-labelledby="contactMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactMessageLabel">Komentar</h5>
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
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/default/js/admin/comments.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/comments/comment_reply.blade.php ENDPATH**/ ?>