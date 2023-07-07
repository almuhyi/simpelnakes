<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Kontak kami</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item">Kontak kami</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="/admin/additional_page/contact_us" method="post">
                                <?php echo e(csrf_field()); ?>


                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label">
                                                Latar Belakang Halaman Kontak</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="input-group-text admin-file-manager" data-input="background_record" data-preview="holder">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="value[background]" id="background_record" value="<?php echo e((!empty($value) and !empty($value['background'])) ? $value['background'] : ''); ?>" class="form-control"/>
                                            </div>
                                        </div>

                                        


                                        

                                        <div class="form-group">
                                            <label class="input-label">No HP</label>
                                            <input type="text" name="value[phones]" value="<?php echo e((!empty($value) and !empty($value['phones'])) ? $value['phones'] : ''); ?>" class="form-control" placeholder="No HP"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label">Email</label>
                                            <input type="text" name="value[emails]" value="<?php echo e((!empty($value) and !empty($value['emails'])) ? $value['emails'] : ''); ?>" class="form-control" placeholder="Email"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label">Alamat</label>
                                            <textarea name="value[address]" rows="5" class="form-control" placeholder="Alamat"><?php echo e((!empty($value) and !empty($value['address'])) ? $value['address'] : ''); ?></textarea>
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
    <script>
        var removeLang = '<?php echo e(('menghapus')); ?>';
    </script>
    <script src="/assets/default/js/admin/contact_us.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/additional_pages/contact_us.blade.php ENDPATH**/ ?>