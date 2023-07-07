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
            <section class="card">
                <div class="card-header">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions_create')): ?>
                        <div class="text-right">
                            <a href="/admin/regions/new?type=<?php echo e($type); ?>" class="btn btn-primary">Baru</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center font-14">

                            <tr>
                                <th class="text-left">Judul</th>

                                <?php if($type == \App\Models\Region::$country): ?>
                                    <th class="text-center">Provinsi</th>
                                <?php elseif($type == \App\Models\Region::$province): ?>
                                    <th class="text-center">Negara</th>
                                    <th class="text-center">Kota</th>
                                <?php elseif($type == \App\Models\Region::$city): ?>
                                    <th class="text-center">Negara</th>
                                    <th class="text-center">Provinsi</th>
                                <?php elseif($type == \App\Models\Region::$district): ?>
                                    <th class="text-center">Negara</th>
                                    <th class="text-center">Provinsi</th>
                                    <th class="text-center">Kota</th>
                                <?php endif; ?>

                                <th class="text-center">Pengguna</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>

                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e($region->title); ?></td>

                                    <?php if($type == \App\Models\Region::$country): ?>
                                        <td><?php echo e($region->countryProvinces->count()); ?></td>
                                        <td><?php echo e($region->countryUsers->count()); ?></td>
                                    <?php elseif($type == \App\Models\Region::$province): ?>
                                        <td><?php echo e($region->country->title); ?></td>
                                        <td><?php echo e($region->provinceCities->count()); ?></td>
                                        <td><?php echo e($region->provinceUsers->count()); ?></td>
                                    <?php elseif($type == \App\Models\Region::$city): ?>
                                        <td><?php echo e($region->country->title); ?></td>
                                        <td><?php echo e($region->province->title); ?></td>
                                        <td><?php echo e($region->cityUsers->count()); ?></td>
                                    <?php elseif($type == \App\Models\Region::$district): ?>
                                        <td><?php echo e($region->country->title); ?></td>
                                        <td><?php echo e($region->province->title); ?></td>
                                        <td><?php echo e($region->city->title); ?></td>
                                        <td><?php echo e($region->districtUsers->count()); ?></td>
                                    <?php endif; ?>

                                    <td><?php echo e(dateTimeFormat($region->created_at, 'Y M j | H:i')); ?></td>

                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions_edit')): ?>
                                            <a href="/admin/regions/<?php echo e($region->id); ?>/edit" class="btn-transparent text-primary mr-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions_delete')): ?>
                                            <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/regions/'.$region->id.'/delete'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <?php echo e($regions->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                </div>
            </section>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/regions/index.blade.php ENDPATH**/ ?>