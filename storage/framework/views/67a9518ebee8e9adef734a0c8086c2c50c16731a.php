<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Kategori blog</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item">Kategori blog</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_categories')): ?>
                                    <?php if(!empty($blogCategories)): ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo e((!empty($errors) and $errors->has('title')) ? '' : 'active'); ?>" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="true">Kategori</a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_categories_create')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo e(((!empty($errors) and $errors->has('title')) or !empty($editCategory)) ? 'active' : ''); ?>" id="newCategory-tab" data-toggle="tab" href="#newCategory" role="tab" aria-controls="newCategory" aria-selected="true">Buat kategori</a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_categories')): ?>
                                    <?php if(!empty($blogCategories)): ?>
                                        <div class="tab-pane mt-3 fade <?php echo e((!empty($errors) and $errors->has('title')) ? '' : 'active show'); ?>" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped font-14">
                                                    <tr>
                                                        <th class="text-left">Judul</th>
                                                        <th class="text-center">Post</th>
                                                        <th>Aksi</th>
                                                    </tr>

                                                    <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td class="text-left"><?php echo e($category->title); ?></td>
                                                            <td class="text-center"><?php echo e($category->blog_count); ?></td>
                                                            <td>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_edit_trending_categories')): ?>
                                                                    <a href="/admin/blog/categories/<?php echo e($category->id); ?>/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_delete_trending_categories')): ?>
                                                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/blog/categories/'. $category->id .'/delete', 'btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_categories_create')): ?>
                                    <div class="tab-pane mt-3 fade <?php echo e(((!empty($errors) and $errors->has('title')) or !empty($editCategory)) ? 'active show' : ''); ?>" id="newCategory" role="tabpanel" aria-labelledby="newCategory-tab">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <form action="/admin/blog/categories/<?php echo e(!empty($editCategory) ? $editCategory->id.'/update' : 'store'); ?>" method="post">
                                                    <?php echo e(csrf_field()); ?>


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
                                                               value="<?php echo e(!empty($editCategory) ? $editCategory->title : ''); ?>"
                                                               placeholder="Judul"/>
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

                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/blog/categories.blade.php ENDPATH**/ ?>