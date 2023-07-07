<div class="tab-pane mt-3 fade" id="purchased_courses" role="tabpanel" aria-labelledby="purchased_courses-tab">
    <div class="row">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment_add_student_to_items')): ?>
            <div class="col-12 col-md-6">
                <h5 class="section-title after-line">Tambah ke dalam pelatihan</h5>

                <form action="/admin/enrollments/store" method="Post">

                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">

                    <div class="form-group">
                        <label class="input-label">Pelatihan</label>
                        <select name="webinar_id" class="form-control search-webinar-select2"
                                data-placeholder="Pilih pelatihan">

                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class=" mt-4">
                        <button type="button" class="js-save-manual-add btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <div class="col-12">
            <div class="mt-5">
                <h5 class="section-title after-line">Pelatihan yang Ditambahkan Secara Manual</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>Pelatihan</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Instruktur</th>
                            <th class="text-center">
                                Tanggal Ditambahkan</th>
                            <th class="text-right">Aksi</th>
                        </tr>

                        <?php if(!empty($manualAddedClasses)): ?>
                            <?php $__currentLoopData = $manualAddedClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manualAddedClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td width="25%">
                                        <a href="<?php echo e(!empty($manualAddedClass->webinar) ? $manualAddedClass->webinar->getUrl() : '#1'); ?>" target="_blank" class=""><?php echo e(!empty($manualAddedClass->webinar) ? $manualAddedClass->webinar->title : 'Hapus'); ?></a>
                                    </td>

                                    <td>
                                        <?php if(!empty($manualAddedClass->webinar)): ?>
                                            <?php echo e($manualAddedClass->webinar->type); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if(!empty($manualAddedClass->webinar)): ?>
                                            <?php echo e(!empty($manualAddedClass->webinar->price) ? handlePrice($manualAddedClass->webinar->price) : '-'); ?>

                                        <?php else: ?>
                                            <?php echo e(!empty($manualAddedClass->amount) ? handlePrice($manualAddedClass->amount) : '-'); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td width="25%">
                                        <?php if(!empty($manualAddedClass->webinar)): ?>
                                            <p><?php echo e($manualAddedClass->webinar->creator->full_name); ?></p>
                                        <?php else: ?>
                                            <p><?php echo e($manualAddedClass->seller->full_name); ?></p>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center"><?php echo e(dateTimeFormat($manualAddedClass->created_at,'j M Y | H:i')); ?></td>
                                    <td class="text-right">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment_block_access')): ?>
                                            <?php echo $__env->make('admin.includes.delete_button',[
                                                    'url' => '/admin/enrollments/'. $manualAddedClass->id .'/block-access',
                                                    'tooltip' => 'Hapus akses',
                                                    'btnIcon' => 'fa-times-circle'
                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </table>
                    <p class="font-12 text-gray mt-1 mb-0">Daftar konten yang ditambahkan untuk peserta ke dalam pelatihan secara manual.</p>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="mt-5">
                <h5 class="section-title after-line">Pelatihan yang Dihapus Secara Manual</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>Pelatihan</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Instruktur</th>
                            <th class="text-right">Aksi</th>
                        </tr>

                        <?php if(!empty($manualDisabledClasses)): ?>
                            <?php $__currentLoopData = $manualDisabledClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manualDisabledClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td width="25%">
                                        <a href="<?php echo e(!empty($manualDisabledClass->webinar) ? $manualDisabledClass->webinar->getUrl() : '#1'); ?>" target="_blank" class=""><?php echo e(!empty($manualDisabledClass->webinar) ? $manualDisabledClass->webinar->title : 'Hapus'); ?></a>
                                    </td>

                                    <td>
                                        <?php if(!empty($manualDisabledClass->webinar)): ?>
                                            <?php echo e($manualDisabledClass->webinar->type); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if(!empty($manualDisabledClass->webinar)): ?>
                                            <?php echo e(!empty($manualDisabledClass->webinar->price) ? handlePrice($manualDisabledClass->webinar->price) : '-'); ?>

                                        <?php else: ?>
                                            <?php echo e(!empty($manualDisabledClass->amount) ? handlePrice($manualDisabledClass->amount) : '-'); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td width="25%">
                                        <?php if(!empty($manualDisabledClass->webinar)): ?>
                                            <p><?php echo e($manualDisabledClass->webinar->creator->full_name); ?></p>
                                        <?php else: ?>
                                            <p><?php echo e($manualDisabledClass->seller->full_name); ?></p>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-right">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment_block_access')): ?>
                                            <?php echo $__env->make('admin.includes.delete_button',[
                                                    'url' => '/admin/enrollments/'. $manualDisabledClass->id .'/enable-access',
                                                    'tooltip' => 'Aktifkan akses',
                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </table>
                    <p class="font-12 text-gray mt-1 mb-0">Daftar konten yang dibeli / diikuti pengguna tetapi akses pengguna dihapus oleh admin.</p>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="mt-5">
                <h5 class="section-title after-line">Diikuti</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>Pelatihan</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Instruktur</th>
                            <th class="text-center">
                                Tanggal Ditambahkan</th>
                            <th class="text-right">Aksi</th>
                        </tr>

                        <?php if(!empty($purchasedClasses)): ?>
                            <?php $__currentLoopData = $purchasedClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchasedClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td width="25%">
                                        <a href="<?php echo e(!empty($purchasedClass->webinar) ? $purchasedClass->webinar->getUrl() : '#1'); ?>" target="_blank" class=""><?php echo e(!empty($purchasedClass->webinar) ? $purchasedClass->webinar->title : 'Hapus'); ?></a>
                                    </td>

                                    <td>
                                        <?php if(!empty($purchasedClass->webinar)): ?>
                                            <?php echo e($purchasedClass->webinar->type); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if(!empty($purchasedClass->webinar)): ?>
                                            <?php echo e(!empty($purchasedClass->webinar->price) ? handlePrice($purchasedClass->webinar->price) : '-'); ?>

                                        <?php else: ?>
                                            <?php echo e(!empty($purchasedClass->amount) ? handlePrice($purchasedClass->amount) : '-'); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td width="25%">
                                        <?php if(!empty($purchasedClass->webinar)): ?>
                                            <p><?php echo e($purchasedClass->webinar->creator->full_name); ?></p>
                                        <?php else: ?>
                                            <p><?php echo e($purchasedClass->seller->full_name); ?></p>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center"><?php echo e(dateTimeFormat($purchasedClass->created_at,'j M Y | H:i')); ?></td>

                                    <td class="text-right">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment_block_access')): ?>
                                            <?php echo $__env->make('admin.includes.delete_button',[
                                                    'url' => '/admin/enrollments/'. $purchasedClass->id .'/block-access',
                                                    'tooltip' => 'Hapus akses',
                                                    'btnIcon' => 'fa-times-circle'
                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </table>
                    <p class="font-12 text-gray mt-1 mb-0">Daftar konten yang dibeli / diikuti pengguna secara normal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/users/editTabs/purchased_courses.blade.php ENDPATH**/ ?>