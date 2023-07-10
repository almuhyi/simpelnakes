<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Daftar Pelatihan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(url('/admin/')); ?>">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Pelatihan</div>

                <div class="breadcrumb-item"><?php echo e($classesType); ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-file-video"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pelatihan</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalWebinars); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-eye"></i>
                        </div>

                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>belum ditinjau</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalPendingWebinars); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <?php if($classesType == 'webinar'): ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-history"></i>
                            </div>

                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Kelas sedang berlangsung</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e($inProgressWebinars); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-history"></i>
                            </div>

                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Durasi</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e(convertMinutesToHourAndMinute($totalDurations)); ?> Jam
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                
            </div>

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <input type="hidden" name="type" value="<?php echo e(request()->get('type')); ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input name="title" type="text" class="form-control" value="<?php echo e(request()->get('title')); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal Mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="from" class="text-center form-control" name="from" value="<?php echo e(request()->get('from')); ?>" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal Berakhir</label>
                                    <div class="input-group">
                                        <input type="date" id="to" class="text-center form-control" name="to" value="<?php echo e(request()->get('to')); ?>" placeholder="End Date">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Filter</label>
                                    <select name="sort" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Filter</option>
                                        <option value="has_discount" <?php if(request()->get('sort') == 'has_discount'): ?> selected <?php endif; ?>>Kelas Diskon</option>
                                        <option value="sales_asc" <?php if(request()->get('sort') == 'sales_asc'): ?> selected <?php endif; ?>>Penjualan ASC</option>
                                        <option value="sales_desc" <?php if(request()->get('sort') == 'sales_desc'): ?> selected <?php endif; ?>>Penjualan DESC</option>
                                        <option value="price_asc" <?php if(request()->get('sort') == 'price_asc'): ?> selected <?php endif; ?>>Harga ASC</option>
                                        <option value="price_desc" <?php if(request()->get('sort') == 'price_desc'): ?> selected <?php endif; ?>>Harga DESC</option>
                                        <option value="income_asc" <?php if(request()->get('sort') == 'income_asc'): ?> selected <?php endif; ?>>Penghasilan ASC</option>
                                        <option value="income_desc" <?php if(request()->get('sort') == 'income_desc'): ?> selected <?php endif; ?>>Penghasilan DESC</option>
                                        <option value="created_at_asc" <?php if(request()->get('sort') == 'created_at_asc'): ?> selected <?php endif; ?>>Tanggal ASC</option>
                                        <option value="created_at_desc" <?php if(request()->get('sort') == 'created_at_desc'): ?> selected <?php endif; ?>>Tanggal DESC</option>
                                        <option value="updated_at_asc" <?php if(request()->get('sort') == 'updated_at_asc'): ?> selected <?php endif; ?>>Update ASC</option>
                                        <option value="updated_at_desc" <?php if(request()->get('sort') == 'updated_at_desc'): ?> selected <?php endif; ?>>Update DESC</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Instruktur</label>
                                    <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role" class="form-control search-user-select2"
                                            data-placeholder="Cari Instruktur">

                                        <?php if(!empty($teachers) and $teachers->count() > 0): ?>
                                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($teacher->id); ?>" selected><?php echo e($teacher->full_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Kategori</label>
                                    <select name="category_id" data-plugin-selectTwo class="form-control populate">
                                        <option value="">All Kategori</option>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                <optgroup label="<?php echo e($category->title); ?>">
                                                    <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($subCategory->id); ?>" <?php if(request()->get('category_id') == $subCategory->id): ?> selected="selected" <?php endif; ?>><?php echo e($subCategory->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </optgroup>
                                            <?php else: ?>
                                                <option value="<?php echo e($category->id); ?>" <?php if(request()->get('category_id') == $category->id): ?> selected="selected" <?php endif; ?>><?php echo e($category->title); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">All Status</option>
                                        <option value="pending" <?php if(request()->get('status') == 'pending'): ?> selected <?php endif; ?>>Tinjauan tertunda</option>
                                        <?php if($classesType == 'webinar'): ?>
                                            <option value="active_not_conducted" <?php if(request()->get('status') == 'active_not_conducted'): ?> selected <?php endif; ?>>Publish tidak dilakukan</option>
                                            <option value="active_in_progress" <?php if(request()->get('status') == 'active_in_progress'): ?> selected <?php endif; ?>>Publish sedang berlangsung</option>
                                            <option value="active_finished" <?php if(request()->get('status') == 'active_finished'): ?> selected <?php endif; ?>>Publish Selesai</option>
                                        <?php else: ?>
                                            <option value="active" <?php if(request()->get('status') == 'active'): ?> selected <?php endif; ?>>Published</option>
                                        <?php endif; ?>
                                        <option value="inactive" <?php if(request()->get('status') == 'inactive'): ?> selected <?php endif; ?>>Ditolak</option>
                                        <option value="is_draft" <?php if(request()->get('status') == 'is_draft'): ?> selected <?php endif; ?>>Draft</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="Lihat">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_export_excel')): ?>
                                <div class="text-right">
                                    <a href="<?php echo e(url('')); ?>/admin/webinars/excel?<?php echo e(http_build_query(request()->all())); ?>" class="btn btn-primary">Export</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Id</th>
                                        <th class="text-left">Judul</th>
                                        <th class="text-left">Instruktur</th>
                                        <th>Harga</th>
                                        <th>Penjualan</th>
                                        <th>Penghasilan</th>
                                        <th>Peserta</th>
                                        <th>Dibuat</th>
                                        <?php if($classesType == 'webinar'): ?>
                                            <th>Tanggal pelaksanaan</th>
                                        <?php else: ?>
                                            <th>Diupdate</th>
                                        <?php endif; ?>
                                        <th>Status</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="text-center">
                                            <td><?php echo e($webinar->id); ?></td>
                                            <td width="18%" class="text-left">
                                                <a class="text-primary mt-0 mb-1 font-weight-bold" href="<?php echo e(url($webinar->getUrl())); ?>"><?php echo e($webinar->title); ?></a>
                                                <?php if(!empty($webinar->category->title)): ?>
                                                    <div class="text-small"><?php echo e($webinar->category->title); ?></div>
                                                <?php else: ?>
                                                    <div class="text-small text-warning">Tidak ada kategori</div>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-left"><?php echo e($webinar->teacher->full_name); ?></td>

                                            <td>
                                                <?php if(!empty($webinar->price) and $webinar->price > 0): ?>
                                                    <span class="mt-0 mb-1">
                                                        <?php echo e(handlePrice($webinar->price, true, true)); ?>

                                                    </span>

                                                    <?php if($webinar->getDiscountPercent() > 0): ?>
                                                        <div class="text-danger text-small font-600-bold"><?php echo e($webinar->getDiscountPercent()); ?>% Off</div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    Gratis
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-primary mt-0 mb-1 font-weight-bold">
                                                    <?php echo e($webinar->sales->count()); ?>

                                                </span>

                                                <?php if($classesType == 'webinar'): ?>
                                                    <div class="text-small font-600-bold">Kapasitas : <?php echo e($webinar->getWebinarCapacity()); ?></div>
                                                <?php endif; ?>
                                            </td>

                                            <td><?php echo e(addCurrencyToPrice($webinar->sales->sum('total_amount'))); ?></td>

                                            <td class="font-12">
                                                <a href="<?php echo e(url('')); ?>/admin/webinars/<?php echo e($webinar->id); ?>/students" target="_blank" class=""><?php echo e($webinar->sales->count()); ?></a>
                                            </td>

                                            <td class="font-12"><?php echo e(dateTimeFormat($webinar->created_at, 'j M Y | H:i')); ?></td>

                                            <?php if($classesType == 'webinar'): ?>
                                                <td class="font-12"><?php echo e(dateTimeFormat($webinar->start_date, 'j M Y | H:i')); ?></td>
                                            <?php else: ?>
                                                <td class="font-12"><?php echo e(dateTimeFormat($webinar->updated_at, 'j M Y | H:i')); ?></td>
                                            <?php endif; ?>

                                            <td>
                                                <?php switch($webinar->status):
                                                    case (\App\Models\Webinar::$active): ?>
                                                    <div class="text-success font-600-bold">Publish</div>
                                                    <?php if($webinar->isWebinar()): ?>
                                                        <?php if($webinar->isProgressing()): ?>
                                                            <div class="text-warning text-small">(Sedang proses)</div>
                                                        <?php elseif($webinar->start_date > time()): ?>
                                                            <div class="text-danger text-small">(Tidak diadakan)</div>
                                                        <?php else: ?>
                                                            <div class="text-success text-small">(Selesai)</div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$isDraft): ?>
                                                    <span class="text-dark">Draft</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$pending): ?>
                                                    <span class="text-warning">Menunggu</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$inactive): ?>
                                                    <span class="text-danger">Ditolak</span>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            </td>
                                            <td width="200" class="">
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu text-left webinars-lists-dropdown">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_notification_to_students')): ?>
                                                            <a href="<?php echo e(url('')); ?>/admin/webinars/<?php echo e($webinar->id); ?>/sendNotification" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                                <i class="fa fa-bell"></i>
                                                                <span class="ml-2">Kirim Pemberitahuan</span>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_students_lists')): ?>
                                                            <a href="<?php echo e(url('')); ?>/admin/webinars/<?php echo e($webinar->id); ?>/students" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 " title="peserta">
                                                                <i class="fa fa-users"></i>
                                                                <span class="ml-2">Peserta</span>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_statistics')): ?>
                                                            <a href="<?php echo e(url('')); ?>/admin/webinars/<?php echo e($webinar->id); ?>/statistics" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 " title="peserta">
                                                                <i class="fa fa-chart-pie"></i>
                                                                <span class="ml-2">Statistik</span>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_support_send')): ?>
                                                            <a href="<?php echo e(url('')); ?>/admin/supports/create?user_id=<?php echo e($webinar->teacher->id); ?>" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1" title="kirim pesan ke instruktur">
                                                                <i class="fa fa-comment"></i>
                                                                <span class="ml-2">Kirim Pesan</span>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_edit')): ?>
                                                            <a href="<?php echo e(url('')); ?>/admin/webinars/<?php echo e($webinar->id); ?>/edit" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 " title="edit">
                                                                <i class="fa fa-edit"></i>
                                                                <span class="ml-2">Edit</span>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_delete')): ?>
                                                            <?php echo $__env->make('admin.includes.delete_button',[
                                                                    'url' => '/admin/webinars/'.$webinar->id.'/delete',
                                                                    'btnClass' => 'd-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm mt-1',
                                                                    'btnText' => '<i class="fa fa-times"></i><span class="ml-2">'. "Hapus" .'</span>'
                                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($webinars->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/webinars/lists.blade.php ENDPATH**/ ?>