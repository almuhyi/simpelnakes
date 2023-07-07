<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Departemen</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Departemen</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body col-12">
                    <div class="tabs">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#list" data-toggle="tab">Departemen </a></li>
                            <li class="nav-item"><a class="nav-link" href="#newitem" data-toggle="tab">Departemen baru</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="list" class="tab-pane active">
                                <div class="table-responsive">
                                    <table class="table table-striped font-14">

                                        <tr>
                                            <th>Departemen</th>
                                            <th class="text-center" width="200">Percakapan</th>
                                            <th class="text-center" width="100">Aksi</th>
                                        </tr>

                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span><?php echo e($department->title); ?></span>
                                                </td>

                                                <td><?php echo e($department->supports_count); ?></td>

                                                <td class="text-center">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_support_departments_edit')): ?>
                                                        <a href="/admin/supports/departments/<?php echo e($department->id); ?>/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_support_departments_delete')): ?>
                                                        <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/supports/departments/'. $department->id.'/delete','btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </table>
                                </div>

                                <div class="text-center mt-2">
                                    <?php echo e($departments->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                                </div>
                            </div>

                            <div id="newitem" class="tab-pane ">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <form action="/admin/supports/departments/store"
                                              method="Post">
                                            <?php echo e(csrf_field()); ?>


                                           <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                                    <div class="form-group">
                                        <label class="input-label">Bahasa</label>
                                        <select name="locale" class="form-control <?php echo e(!empty($department) ? 'js-edit-content-locale' : ''); ?>">
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


                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" name="title"
                                                       class="form-control  <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                       value="<?php echo e(old('title')); ?>"/>
                                                <?php $__errorArgs = ['title'];
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

                                            <div class="text-right mt-4">
                                                <button class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/supports/departments.blade.php ENDPATH**/ ?>