<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Alasan laporan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item">Alasan laporan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="/admin/reports/reasons" method="post">
                                <?php echo e(csrf_field()); ?>


                                <div class="row">
                                    <div class="col-12 col-md-6">

                                        <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                                            <div class="form-group">
                                                <label class="input-label">Bahasa</label>
                                                <select name="locale" class="form-control js-edit-content-locale">
                                                    <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($lang); ?>" <?php if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)): ?> selected <?php endif; ?>><?php echo e($language); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['locale'];
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
                                        <?php else: ?>
                                            <input type="hidden" name="locale" value="<?php echo e(getDefaultLocale()); ?>">
                                        <?php endif; ?>


                                        <div id="addAccountTypes" class="ml-0">
                                            <strong class="d-block mb-4">Tambahkan Alasan Laporan</strong>

                                            <div class="form-group main-row">
                                                <div class="d-flex align-items-stretch">
                                                    <input type="text" name="value[]"
                                                           class="form-control w-auto flex-grow-1"
                                                           placeholder="Judul"/>

                                                    <button type="button" class="btn btn-success add-btn fas fa-plus ml-2"></button>
                                                </div>
                                                <div class="text-muted text-small mt-1">Report resons akan ditampilkan dalam report modal sehingga pengguna dapat memilih salah satunya dan melaporkannya.</div>
                                            </div>

                                            <?php if(!empty($value) and count($value)): ?>
                                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-group">
                                                        <div class="d-flex align-items-stretch">
                                                            <input type="text" name="value[]"
                                                                   class="form-control w-auto flex-grow-1"
                                                                   value="<?php echo e($item); ?>"
                                                                   placeholder="Judul"/>

                                                            <button type="button" class="btn fas fa-times remove-btn btn-danger ml-2"></button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
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
    <script src="/assets/default/js/admin/reports.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/reports/reasons.blade.php ENDPATH**/ ?>