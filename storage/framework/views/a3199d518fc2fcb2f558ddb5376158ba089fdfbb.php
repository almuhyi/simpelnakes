<?php $__env->startSection('content'); ?>
    <div class="container become-instructor-packages">
        <div class="text-center mt-50">
            <h1 class="font-36 font-weight-bold text-dark">Paket SaaS</h1>
            <p class="font-16 font-weight-normal text-gray mt-10">Pilih paket SaaS sesuai kebutuhan Anda dan mulailah...</p>

            <?php if(empty($becomeInstructor)): ?>
                <a href="/become-instructor" class="btn btn-primary mt-15">Menjadi Instruktur</a>
            <?php endif; ?>
        </div>

        <?php if(!empty($defaultPackage)): ?>
            <div class="d-flex align-items-center flex-column flex-lg-row mt-50 border rounded-lg p-15 p-lg-25">
                <div class="default-package-icon">
                    <img src="/assets/default/img/become-instructor/default.png" class="img-cover" alt="Paket Bawaan">
                </div>

                <div class="ml-lg-25 w-100 mt-20 mt-lg-0">
                    <h2 class="font-24 font-weight-bold text-dark-blue">Paket Bawaan</h2>
                    <p class="font-14 font-weight-500 text-gray">Anda akan memiliki akses ke parameter ini tanpa membeli paket</p>

                    <div class="d-flex flex-wrap align-items-center justify-content-between w-100">

                        <div class="d-flex align-items-center mt-20">
                            <div class="default-package-statistics-icon">
                                <img src="/assets/default/img/icons/play.svg" alt="play">
                            </div>

                            <span class="font-12 text-dark-blue font-weight-bold mx-1">
                               <?php echo e($defaultPackage->courses_count ?? ('
                               Tak terbatas')); ?>

                            </span>
                            <span class="font-14 font-weight-500 text-gray">Pelatihan</span>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                            <div class="default-package-statistics-icon">
                                <img src="/assets/default/img/icons/video-2.svg" alt="video-2">
                            </div>

                            <span class="font-12 text-dark-blue font-weight-bold mx-1">
                               <?php echo e($defaultPackage->courses_capacity ?? ('Tak terbatas')); ?>

                            </span>
                            <span class="font-14 font-weight-500 text-gray">Pertemuan online</span>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                            <div class="default-package-statistics-icon">
                                <img src="/assets/default/img/icons/clock.svg" alt="clock">
                            </div>

                            <span class="font-12 text-dark-blue font-weight-bold mx-1">
                               <?php echo e($defaultPackage->meeting_count ?? ('Tak terbatas')); ?>

                            </span>
                            <span class="font-14 font-weight-500 text-gray">Slot waktu rapat</span>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                            <div class="default-package-statistics-icon">
                                <img src="/assets/default/img/icons/clock.svg" alt="clock">
                            </div>

                            <span class="font-12 text-dark-blue font-weight-bold mx-1">
                               <?php echo e($defaultPackage->product_count ?? ('Tak terbatas')); ?>

                            </span>
                            <span class="font-14 font-weight-500 text-gray">Produk</span>
                        </div>

                        <?php if($selectedRole == 'organizations'): ?>
                            <div class="d-flex align-items-center mt-20">
                                <div class="default-package-statistics-icon">
                                    <img src="/assets/default/img/icons/users.svg" alt="users">
                                </div>

                                <span class="font-12 text-dark-blue font-weight-bold mx-1">
                                   <?php echo e($defaultPackage->instructors_count ?? ('Tak terbatas')); ?>

                                </span>
                                <span class="font-14 font-weight-500 text-gray">Instruktur</span>
                            </div>

                            <div class="d-flex align-items-center mt-20">
                                <div class="default-package-statistics-icon">
                                    <img src="/assets/default/img/icons/user.svg" alt="user">
                                </div>

                                <span class="font-12 text-dark-blue font-weight-bold mx-1">
                                   <?php echo e($defaultPackage->students_count ?? ('Tak terbatas')); ?>

                                </span>
                                <span class="font-14 font-weight-500 text-gray">Peserta</span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('payRegistrationPackage')); ?>" method="post">
            <?php echo e(csrf_field()); ?>


            <?php if(!empty($becomeInstructor)): ?>
                <input type="hidden" name="become_instructor_id" value="<?php echo e($becomeInstructor->id); ?>"/>
            <?php endif; ?>

            <div class="row mt-20">
                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-lg-4 mt-15 <?php echo e(!empty($becomeInstructor) ? 'charge-account-radio' : ''); ?>">
                        <?php if(!empty($becomeInstructor)): ?>
                            <input type="radio" name="id" id="package<?php echo e($package->id); ?>" value="<?php echo e($package->id); ?>">
                        <?php endif; ?>

                        <label for="package<?php echo e($package->id); ?>" class="subscribe-plan cursor-pointer position-relative bg-white d-flex flex-column align-items-center rounded-sm shadow pt-50 pb-20 px-20">

                            <?php if(!empty($activePackage) and $activePackage->package_id == $package->id): ?>
                                <span class="badge badge-primary badge-popular px-15 py-5">Aktif</span>
                            <?php endif; ?>


                            <div class="plan-icon">
                                <img src="<?php echo e($package->icon); ?>" class="img-cover" alt="">
                            </div>

                            <h3 class="mt-20 font-30 text-secondary"><?php echo e($package->title); ?></h3>
                            <p class="font-weight-500 font-14 text-gray mt-10"><?php echo e($package->description); ?></p>

                            <div class="d-flex align-items-start text-primary mt-30">
                                <span class="font-36 line-height-1"><?php echo e(addCurrencyToPrice($package->price)); ?></span>
                            </div>

                            <ul class="mt-20 plan-feature">
                                <li class="mt-10"><?php echo e($package->days ?? ('Tak terbatas')); ?> Hari</li>
                                <li class="mt-10"><?php echo e($package->courses_count ?? ('Tak terbatas')); ?> Pelatihan</li>
                                <li class="mt-10"><?php echo e($package->courses_capacity ?? ('Tak terbatas')); ?> Pertemuan online</li>
                                <li class="mt-10"><?php echo e($package->meeting_count ?? ('Tak terbatas')); ?> Slot waktu rapat</li>
                                <li class="mt-10"><?php echo e($package->product_count ?? ('Tak terbatas')); ?> Produk</li>

                                <?php if($selectedRole == 'organizations'): ?>
                                    <li class="mt-10"><?php echo e($package->instructors_count ?? ('Tak terbatas')); ?> Instruktur</li>
                                    <li class="mt-10"><?php echo e($package->students_count ?? ('Tak terbatas')); ?> Peserta</li>
                                <?php endif; ?>
                            </ul>
                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if(!empty($becomeInstructor)): ?>
                <div class="d-flex align-items-center justify-content-between mt-20 pt-10 border-top">
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-border-white">Kembali</a>

                    <div class="">
                        <?php if(!getRegistrationPackagesGeneralSettings('force_user_to_select_a_package')): ?>
                            <a href="/panel" class="btn btn-sm btn-primary mr-5">Lewati</a>
                        <?php endif; ?>

                        <button type="submit" id="paymentSubmit" disabled class="btn btn-sm btn-primary">Periksa</button>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/js/parts/become_instructor.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/user/become_instructor/packages.blade.php ENDPATH**/ ?>