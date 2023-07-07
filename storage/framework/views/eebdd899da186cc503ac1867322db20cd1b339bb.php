<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>
                404 Pengaturan Halaman</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item">404</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="/admin/additional_page/404" method="post">
                                <?php echo e(csrf_field()); ?>


                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label">Gambar 404</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="input-group-text admin-file-manager" data-input="error_image" data-preview="holder">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="value[error_image]" id="error_image" value="<?php echo e((!empty($value) and !empty($value['error_image'])) ? $value['error_image'] : ''); ?>" class="form-control"/>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="input-label">Judul kesalahan 404</label>
                                            <input type="text" name="value[error_title]" value="<?php echo e((!empty($value) and !empty($value['error_title'])) ? $value['error_title'] : ''); ?>" class="form-control"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label">Error deskripsi 404</label>
                                            <textarea name="value[error_description]" rows="7" class="form-control"><?php echo e((!empty($value) and !empty($value['error_description'])) ? $value['error_description'] : ''); ?></textarea>
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
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/additional_pages/404.blade.php ENDPATH**/ ?>