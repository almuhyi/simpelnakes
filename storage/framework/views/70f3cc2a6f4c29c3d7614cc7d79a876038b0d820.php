<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Penjualan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Penjualan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total penjualan</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($totalSales['count']); ?>

                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-play-circle"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pelatihan</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($classesSales['count']); ?>

                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-calendar-alt"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pertemuan</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($appointmentSales['count']); ?>

                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-times"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Gagal</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($failedSales); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" class="form-control" name="item_title" value="<?php echo e(request()->get('item_title')); ?>">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="from" value="<?php echo e(request()->get('from')); ?>" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal akhir</label>
                                    <div class="input-group">
                                        <input type="date" id="lsdate" class="text-center form-control" name="to" value="<?php echo e(request()->get('to')); ?>" placeholder="End Date">
                                    </div>
                                </div>
                            </div>


                            


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Pelatihan</label>
                                    <select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2"
                                            data-placeholder="Search classes">

                                        <?php if(!empty($webinars) and $webinars->count() > 0): ?>
                                            <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($webinar->id); ?>" selected><?php echo e($webinar->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Instruktur</label>
                                    <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role" class="form-control search-user-select2"
                                            data-placeholder="Search teachers">

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
                                    <label class="input-label">Peserta</label>
                                    <select name="student_ids[]" multiple="multiple" data-search-option="just_student_role" class="form-control search-user-select2"
                                            data-placeholder="Search students">

                                        <?php if(!empty($students) and $students->count() > 0): ?>
                                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($student->id); ?>" selected><?php echo e($student->full_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="Lihat hasil">
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_sales_export')): ?>
                                <a href="/admin/financial/sales/export" class="btn btn-primary">Export excel</a>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Peserta</th>
                                        <th class="text-left">Instruktur</th>
                                        <th>Jumlah</th>
                                        <th>Diskon</th>
                                        <th>Pajak</th>
                                        <th class="text-left">Item</th>
                                        <th>Jenis Penjualan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($sale->id); ?></td>

                                            <td class="text-left">
                                                <?php echo e(!empty($sale->buyer) ? $sale->buyer->full_name : ''); ?>

                                                <div class="text-primary text-small font-600-bold">ID : <?php echo e(!empty($sale->buyer) ? $sale->buyer->id : ''); ?></div>
                                            </td>

                                            <td class="text-left">
                                                <?php echo e($sale->item_seller); ?>

                                                <div class="text-primary text-small font-600-bold">ID : <?php echo e($sale->seller_id); ?></div>
                                            </td>

                                            <td>
                                                <?php if($sale->payment_method == \App\Models\Sale::$subscribe): ?>
                                                    <span class="">Berlangganan</span>
                                                <?php else: ?>
                                                    <?php if(!empty($sale->total_amount)): ?>
                                                        <span class=""><?php echo e(addCurrencyToPrice(handlePriceFormat($sale->total_amount))); ?></span>
                                                    <?php else: ?>
                                                        <span class="">Gratis</span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class=""><?php echo e(addCurrencyToPrice(handlePriceFormat($sale->discount))); ?></span>
                                            </td>
                                            <td>
                                                <span class=""><?php echo e(addCurrencyToPrice(handlePriceFormat($sale->tax))); ?></span>
                                            </td>
                                            <td class="text-left">
                                                <div class="media-body">
                                                    <div><?php echo e($sale->item_title); ?></div>
                                                    <div class="text-primary text-small font-600-bold">ID : <?php echo e($sale->item_id); ?></div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="font-weight-bold">
                                                    <?php if($sale->type == \App\Models\Sale::$registrationPackage): ?>
                                                        Paket SaaS
                                                    <?php elseif($sale->type == \App\Models\Sale::$product): ?>
                                                        Produk
                                                    <?php elseif($sale->type == \App\Models\Sale::$bundle): ?>
                                                        Bundel
                                                    <?php else: ?>
                                                        <?php echo e($sale->type); ?>

                                                    <?php endif; ?>
                                                </span>
                                            </td>

                                            <td><?php echo e(dateTimeFormat($sale->created_at, 'j F Y H:i')); ?></td>

                                            <td>
                                                <?php if(!empty($sale->refund_at)): ?>
                                                    <span class="text-warning">Pengembalian dana</span>
                                                <?php elseif(!$sale->access_to_purchased_item): ?>
                                                    <span class="text-danger">Akses diblokir</span>
                                                <?php else: ?>
                                                    <span class="text-success">Sukses</span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_sales_invoice')): ?>
                                                    <?php if(!empty($sale->webinar_id)): ?>
                                                        <a href="/admin/financial/sales/<?php echo e($sale->id); ?>/invoice" target="_blank" title="Faktur"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_sales_refund')): ?>
                                                    <?php if(empty($sale->refund_at) and $sale->payment_method != \App\Models\Sale::$subscribe): ?>
                                                        <?php echo $__env->make('admin.includes.delete_button',[
                                                                'url' => '/admin/financial/sales/'. $sale->id .'/refund',
                                                                'tooltip' => 'pengembalian dana',
                                                                'btnIcon' => 'fa-times-circle'
                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($sales->appends(request()->input())->links('vendor.pagination.bootstrap-4')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/financial/sales/lists.blade.php ENDPATH**/ ?>