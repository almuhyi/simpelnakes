<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/css/css-stars.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/video/video-js.min.css">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <section class="course-cover-container <?php echo e(empty($activeSpecialOffer) ? 'not-active-special-offer' : ''); ?>">
        <img src="<?php echo e(asset($course->getImageCover())); ?>" class="img-cover course-cover-img" alt="<?php echo e($course->title); ?>"/>

        <div class="cover-content pt-40">
            <div class="container position-relative">
                <?php if(!empty($activeSpecialOffer)): ?>
                    <?php echo $__env->make('web.default.course.special_offer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="container course-content-section <?php echo e($course->type); ?> <?php echo e(($hasBought or $course->isWebinar()) ? 'has-progress-bar' : ''); ?>">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="course-content-body user-select-none">
                    <div class="course-body-on-cover text-white">
                        <h1 class="font-30 course-title">
                            <?php echo e(clean($course->title, 't')); ?>

                        </h1>

                        <?php if(!empty($course->category)): ?>
                            <span class="d-block font-16 mt-10">Kategori <a href="<?php echo e(url($course->category->getUrl())); ?>" target="_blank" class="font-weight-500 text-decoration-underline text-white"><?php echo e($course->category->title); ?></a></span>
                        <?php endif; ?>

                        <div class="d-flex align-items-center">
                            <?php echo $__env->make('web.default.includes.webinar.rate',['rate' => $course->getRate()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <span class="ml-10 mt-15 font-14">(<?php echo e($course->reviews->pluck('creator_id')->count()); ?> Ulasan)</span>
                        </div>

                        <div class="mt-15">
                            <span class="font-14">Dibuat oleh</span>
                            <a href="<?php echo e(url($course->teacher->getProfileUrl())); ?>" target="_blank" class="text-decoration-underline text-white font-14 font-weight-500"><?php echo e($course->teacher->full_name); ?></a>
                        </div>

                        <?php if($hasBought or $course->isWebinar()): ?>
                            <?php
                                $percent = $course->getProgress();
                            ?>

                            <div class="mt-30 d-flex align-items-center">
                                <div class="progress course-progress flex-grow-1 shadow-xs rounded-sm">
                                    <span class="progress-bar rounded-sm bg-warning" style="width: <?php echo e($percent); ?>%"></span>
                                </div>

                                <span class="ml-15 font-14 font-weight-500">
                                    <?php if($course->isWebinar()): ?>
                                        <?php if($hasBought and $course->isProgressing()): ?>
                                            <?php echo e($percent); ?>% dari pelatihan lulus.
                                        <?php else: ?>
                                            <?php echo e($course->sales_count); ?>/<?php echo e($course->capacity); ?> Peserta
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e($percent); ?>% dari pelatihan lulus.
                                    <?php endif; ?>
                            </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-35">
                        <ul class="nav nav-tabs bg-secondary rounded-sm p-15 d-flex align-items-center justify-content-between" id="tabs-tab" role="tablist">
                            <li class="nav-item">
                                <a class="position-relative font-14 text-white <?php echo e((empty(request()->get('tab','')) or request()->get('tab','') == 'information') ? 'active' : ''); ?>" id="information-tab"
                                   data-toggle="tab" href="#information" role="tab" aria-controls="information"
                                   aria-selected="true">Informasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="position-relative font-14 text-white <?php echo e((request()->get('tab','') == 'content') ? 'active' : ''); ?>" id="content-tab" data-toggle="tab"
                                   href="#content" role="tab" aria-controls="content"
                                   aria-selected="false">Materi (<?php echo e($webinarContentCount); ?>)</a>
                            </li>
                            <li class="nav-item">
                                <a class="position-relative font-14 text-white <?php echo e((request()->get('tab','') == 'reviews') ? 'active' : ''); ?>" id="reviews-tab" data-toggle="tab"
                                   href="#reviews" role="tab" aria-controls="reviews"
                                   aria-selected="false">Ulasan (<?php echo e($course->reviews->count() > 0 ? $course->reviews->pluck('creator_id')->count() : 0); ?>)</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade <?php echo e((empty(request()->get('tab','')) or request()->get('tab','') == 'information') ? 'show active' : ''); ?> " id="information" role="tabpanel"
                                 aria-labelledby="information-tab">
                                <?php echo $__env->make(getTemplate().'.course.tabs.information', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="tab-pane fade <?php echo e((request()->get('tab','') == 'content') ? 'show active' : ''); ?>" id="content" role="tabpanel" aria-labelledby="content-tab">
                                <?php echo $__env->make(getTemplate().'.course.tabs.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="tab-pane fade <?php echo e((request()->get('tab','') == 'reviews') ? 'show active' : ''); ?>" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <?php echo $__env->make(getTemplate().'.course.tabs.reviews', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="course-content-sidebar col-12 col-lg-4 mt-25 mt-lg-0">
                <div class="rounded-lg shadow-sm">
                    <div class="course-img <?php echo e($course->video_demo ? 'has-video' :''); ?>">

                        <img src="<?php echo e(asset($course->getImage())); ?>" class="img-cover" alt="">

                        <?php if($course->video_demo): ?>
                            <div id="webinarDemoVideoBtn"
                                 data-video-path="<?php echo e($course->video_demo_source == 'upload' ?  url($course->video_demo) : $course->video_demo); ?>"
                                 data-video-source="<?php echo e($course->video_demo_source); ?>"
                                 class="course-video-icon cursor-pointer d-flex align-items-center justify-content-center">
                                <i data-feather="play" width="25" height="25"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="px-20 pb-30">
                        <form action="<?php echo e(url('/cart/store')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="item_id" value="<?php echo e($course->id); ?>">
                            <input type="hidden" name="item_name" value="webinar_id">

                            <?php if(!empty($course->tickets)): ?>
                                <?php $__currentLoopData = $course->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="form-check mt-20">
                                        <input class="form-check-input" <?php if(!$ticket->isValid()): ?> disabled <?php endif; ?> type="radio" data-discount="<?php echo e($ticket->discount); ?>" value="<?php echo e(($ticket->isValid()) ? $ticket->id : ''); ?>"
                                               name="ticket_id"
                                               id="courseOff<?php echo e($ticket->id); ?>">
                                        <label class="form-check-label d-flex flex-column cursor-pointer" for="courseOff<?php echo e($ticket->id); ?>">
                                            <span class="font-16 font-weight-500 text-dark-blue"><?php echo e($ticket->title); ?> <?php if(!empty($ticket->discount)): ?>
                                                    (<?php echo e($ticket->discount); ?>% Off)
                                                <?php endif; ?></span>
                                            <span class="font-14 text-gray"><?php echo e($ticket->getSubTitle()); ?></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if($course->price > 0): ?>
                                <div id="priceBox" class="d-flex align-items-center justify-content-center mt-20 <?php echo e(!empty($activeSpecialOffer) ? ' flex-column ' : ''); ?>">
                                    <div class="text-center">
                                        <?php
                                            $realPrice = handleCoursePagePrice($course->price);
                                        ?>
                                        <span id="realPrice" data-value="<?php echo e($course->price); ?>"
                                              data-special-offer="<?php echo e(!empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''); ?>"
                                              class="d-block <?php if(!empty($activeSpecialOffer)): ?> font-16 text-gray text-decoration-line-through <?php else: ?> font-30 text-primary <?php endif; ?>">
                                            <?php echo e($realPrice['price']); ?>

                                        </span>

                                        <?php if(!empty($realPrice['tax']) and empty($activeSpecialOffer)): ?>
                                            <span class="d-block font-14 text-gray">+ <?php echo e($realPrice['tax']); ?> tax</span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if(!empty($activeSpecialOffer)): ?>
                                        <div class="text-center">
                                            <?php
                                                $priceWithDiscount = handleCoursePagePrice($course->price - ($course->price * $activeSpecialOffer->percent / 100));
                                            ?>
                                            <span id="priceWithDiscount"
                                                  class="d-block font-30 text-primary">
                                                <?php echo e($priceWithDiscount['price']); ?>

                                            </span>

                                            <?php if(!empty($priceWithDiscount['tax'])): ?>
                                                <span class="d-block font-14 text-gray">+ <?php echo e($priceWithDiscount['tax']); ?> tax</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center mt-20">
                                    <span class="font-36 text-primary">Gratis</span>
                                </div>
                            <?php endif; ?>

                            <?php
                                $canSale = ($course->canSale() and !$hasBought);
                            ?>

                            <div class="mt-20 d-flex flex-column">
                                <?php if($hasBought): ?>
                                    <a href="<?php echo e(url($course->getLearningPageUrl())); ?>" class="btn btn-primary">Pergi ke halaman pelatihan</a>
                                <?php elseif($course->price > 0): ?>
                                    <button type="button" class="btn btn-primary <?php echo e($canSale ? 'js-course-add-to-cart-btn' : ($course->cantSaleStatus($hasBought) .' disabled ')); ?>">
                                        <?php if(!$canSale): ?>
                                            Pelatihan sedang diselenggarakan
                                        <?php else: ?>
                                            Tambah ke keranjang
                                        <?php endif; ?>
                                    </button>

                                    <?php if($canSale and $course->subscribe): ?>
                                        <a href="<?php echo e(url('')); ?>/subscribes/apply/<?php echo e($course->slug); ?>" class="btn btn-outline-primary btn-subscribe mt-20 <?php if(!$canSale): ?> disabled <?php endif; ?>">
                                            Langganan</a>
                                    <?php endif; ?>

                                    <?php if($canSale and !empty($course->points)): ?>
                                        <a href="<?php echo e(url(!(auth()->check()) ? '/login' : '#')); ?>" class="<?php echo e((auth()->check()) ? 'js-buy-with-point' : ''); ?> btn btn-outline-warning mt-20 <?php echo e((!$canSale) ? 'disabled' : ''); ?>" rel="nofollow">
                                            Beli dengan <?php echo $course->points; ?> point
                                        </a>
                                    <?php endif; ?>

                                    <?php if($canSale and !empty(getFeaturesSettings('direct_classes_payment_button_status'))): ?>
                                        <button type="button" class="btn btn-outline-danger mt-20 js-course-direct-payment">
                                            Beli sekarang!
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?php echo e(url($canSale ? '/course/'. $course->slug .'/free' : '#')); ?>" class="btn btn-primary <?php echo e((!$canSale) ? (' disabled ' . $course->cantSaleStatus($hasBought)) : ''); ?>">Daftar di pelatihan</a>
                                <?php endif; ?>
                            </div>

                        </form>

                        <?php if(!empty(getOthersPersonalizationSettings('show_guarantee_text')) and getOthersPersonalizationSettings('show_guarantee_text')): ?>
                            <div class="mt-20 d-flex align-items-center justify-content-center text-gray">
                                <i data-feather="thumbs-up" width="20" height="20"></i>
                                <span class="ml-5 font-14"><?php echo e(getOthersPersonalizationSettings('guarantee_text')); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="mt-35">
                            <strong class="d-block text-secondary font-weight-bold"><?php echo e($course->type); ?> ini meliputi</strong>
                            <?php if($course->isDownloadable()): ?>
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="download-cloud" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">materi bisa didownload</span>
                                </div>
                            <?php endif; ?>

                            <?php if($course->quizzes->where('certificate', 1)->count() > 0): ?>
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="award" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">Sertifikat resmi</span>
                                </div>
                            <?php endif; ?>

                            <?php if($course->quizzes->where('status', \App\models\Quiz::ACTIVE)->count() > 0): ?>
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="file-text" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500"><?php echo e($course->quizzes->where('status', \App\models\Quiz::ACTIVE)->count()); ?> Kuis Online</span>
                                </div>
                            <?php endif; ?>

                            <?php if($course->support): ?>
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="headphones" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">Dukungan instruktur</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-40 p-10 rounded-sm border row align-items-center favorites-share-box">
                            <?php if($course->isWebinar()): ?>
                                <div class="col">
                                    <a href="<?php echo e(url($course->addToCalendarLink())); ?>" target="_blank" class="d-flex flex-column align-items-center text-center text-gray">
                                        <i data-feather="calendar" width="20" height="20"></i>
                                        <span class="font-12">Pengingat</span>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="col">
                                <a href="<?php echo e(url('')); ?>/favorites/<?php echo e($course->slug); ?>/toggle" id="favoriteToggle" class="d-flex flex-column align-items-center text-gray">
                                    <i data-feather="heart" class="<?php echo e(!empty($isFavorite) ? 'favorite-active' : ''); ?>" width="20" height="20"></i>
                                    <span class="font-12">Favorit</span>
                                </a>
                            </div>

                            <div class="col">
                                <a href="#" class="js-share-course d-flex flex-column align-items-center text-gray">
                                    <i data-feather="share-2" width="20" height="20"></i>
                                    <span class="font-12">Bagikan</span>
                                </a>
                            </div>
                        </div>

                        <div class="mt-30 text-center">
                            <button type="button" id="webinarReportBtn" class="font-14 text-gray btn-transparent">Laporkan pelatihan ini</button>
                        </div>
                    </div>
                </div>

                <?php if($course->teacher->offline): ?>
                    <div class="rounded-lg shadow-sm mt-35 d-flex">
                        <div class="offline-icon offline-icon-left d-flex align-items-stretch">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo e(asset('')); ?>assets/default/img/profile/time-icon.png" alt="offline">
                            </div>
                        </div>

                        <div class="p-15">
                            <h3 class="font-16 text-dark-blue">
                                Instruktur untuk sementara tidak tersedia.</h3>
                            <p class="font-14 font-weight-500 text-gray mt-15"><?php echo e($course->teacher->offline_message); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="rounded-lg shadow-sm mt-35 px-25 py-20">
                    <h3 class="sidebar-title font-16 text-secondary font-weight-bold"><?php echo e($course->type .' '. ('Spesifikasi')); ?></h3>

                    <div class="mt-30">
                        <?php if($course->isWebinar()): ?>
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <i data-feather="calendar" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">Mulai tanggal:</span>
                                </div>
                                <span class="font-14"><?php echo e(dateTimeFormat($course->start_date, 'j M Y | H:i')); ?></span>
                            </div>

                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <i data-feather="user" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">Kapasitas:</span>
                                </div>
                                <span class="font-14"><?php echo e($course->capacity); ?> Peserta</span>
                            </div>
                        <?php endif; ?>

                        <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                            <div class="d-flex align-items-center">
                                <i data-feather="clock" width="20" height="20"></i>
                                <span class="ml-5 font-14 font-weight-500">Durasi:</span>
                            </div>
                            <span class="font-14"><?php echo e(convertMinutesToHourAndMinute(!empty($course->duration) ? $course->duration : 0)); ?> Jam</span>
                        </div>

                        <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                            <div class="d-flex align-items-center">
                                <i data-feather="users" width="20" height="20"></i>
                                <span class="ml-5 font-14 font-weight-500">Peserta:</span>
                            </div>
                            <span class="font-14"><?php echo e($course->sales_count); ?></span>
                        </div>

                        <?php if($course->isWebinar()): ?>
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo e(asset('')); ?>assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">Sesi:</span>
                                </div>
                                <span class="font-14"><?php echo e($course->sessions->count()); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($course->isTextCourse()): ?>
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo e(asset('')); ?>assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">Pelajaran teks:</span>
                                </div>
                                <span class="font-14"><?php echo e($course->textLessons->count()); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($course->isCourse() or $course->isTextCourse()): ?>
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo e(asset('')); ?>assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">File:</span>
                                </div>
                                <span class="font-14"><?php echo e($course->files->count()); ?></span>
                            </div>

                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo e(asset('')); ?>assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">Dibuat pada:</span>
                                </div>
                                <span class="font-14"><?php echo e(dateTimeFormat($course->created_at,'j M Y')); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($course->access_days)): ?>
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <i data-feather="alert-circle" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">Periode Akses:</span>
                                </div>
                                <span class="font-14"><?php echo e($course->access_days); ?> Hari</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                
                <?php if($course->creator_id != $course->teacher_id): ?>
                    <?php echo $__env->make('web.default.course.sidebar_instructor_profile', ['courseTeacher' => $course->creator], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                
                <?php echo $__env->make('web.default.course.sidebar_instructor_profile', ['courseTeacher' => $course->teacher], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if($course->webinarPartnerTeacher->count() > 0): ?>
                    <?php $__currentLoopData = $course->webinarPartnerTeacher; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinarPartnerTeacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.default.course.sidebar_instructor_profile', ['courseTeacher' => $webinarPartnerTeacher->teacher], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                

                
                <?php if($course->tags->count() > 0): ?>
                    <div class="rounded-lg tags-card shadow-sm mt-35 px-25 py-20">
                        <h3 class="sidebar-title font-16 text-secondary font-weight-bold">Tag</h3>

                        <div class="d-flex flex-wrap mt-10">
                            <?php $__currentLoopData = $course->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="" class="tag-item bg-gray200 p-5 font-14 text-gray font-weight-500 rounded"><?php echo e($tag->title); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if(!empty($advertisingBannersSidebar) and count($advertisingBannersSidebar)): ?>
                    <div class="row">
                        <?php $__currentLoopData = $advertisingBannersSidebar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sidebarBanner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="rounded-lg sidebar-ads mt-35 col-<?php echo e($sidebarBanner->size); ?>">
                                <a href="<?php echo e(url($sidebarBanner->link)); ?>">
                                    <img src="<?php echo e(asset($sidebarBanner->image)); ?>" class="img-cover rounded-lg" alt="<?php echo e($sidebarBanner->title); ?>">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>

        
        <?php if(!empty($advertisingBanners) and count($advertisingBanners)): ?>
            <div class="mt-30 mt-md-50">
                <div class="row">
                    <?php $__currentLoopData = $advertisingBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-<?php echo e($banner->size); ?>">
                            <a href="<?php echo e(url($banner->link)); ?>">
                                <img src="<?php echo e(asset($banner->image)); ?>" class="img-cover rounded-sm" alt="<?php echo e($banner->title); ?>">
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
        
    </section>

    <div id="webinarReportModal" class="d-none">
        <h3 class="section-title after-line font-20 text-dark-blue">Laporkan pelatihan</h3>

        <form action="<?php echo e(url('')); ?>/course/<?php echo e($course->id); ?>/report" method="post" class="mt-25">

            <div class="form-group">
                <label class="text-dark-blue font-14">Alasan</label>
                <select id="reason" name="reason" class="form-control">
                    <option value="" selected disabled>Pilih alasan</option>

                    <?php $__currentLoopData = getReportReasons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($reason); ?>"><?php echo e($reason); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label class="text-dark-blue font-14" for="message_to_reviewer">Pesan untuk peninjau</label>
                <textarea name="message" id="message_to_reviewer" class="form-control" rows="10"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <p class="text-gray font-16">Tolong jelaskan tentang laporan secara singkat dan jelas.</p>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-course-report-submit btn btn-sm btn-primary">Laporkan</button>
                <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutup</button>
            </div>
        </form>
    </div>

    <?php echo $__env->make('web.default.course.share_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('web.default.course.buy_with_point_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/time-counter-down.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/barrating/jquery.barrating.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/video/video.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/video/youtube.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/video/vimeo.js"></script>

    <script>
        var webinarDemoLang = '<?php echo e(('Demo pelatihan')); ?>';
        var replyLang = '<?php echo e(('Balas')); ?>';
        var closeLang = '<?php echo e(('Tutup')); ?>';
        var saveLang = '<?php echo e(('Simpan')); ?>';
        var reportLang = '<?php echo e(('Laporkan')); ?>';
        var reportSuccessLang = '<?php echo e(('Laporan Anda telah dikirim.')); ?>';
        var reportFailLang = '<?php echo e(('Laporan gagal. Pastikan Anda sudah masuk.')); ?>';
        var messageToReviewerLang = '<?php echo e(('Pesan untuk peninjau')); ?>';
        var copyLang = '<?php echo e(('Salin')); ?>';
        var copiedLang = '<?php echo e(('Disalin')); ?>';
        var learningToggleLangSuccess = '<?php echo e(('Status pembelajaran Anda berhasil diubah.')); ?>';
        var learningToggleLangError = '<?php echo e(('Gagal mengubah status pembelajaran.')); ?>';
        var notLoginToastTitleLang = '<?php echo e(('materi yang dibatasi')); ?>';
        var notLoginToastMsgLang = '<?php echo e(('Silahkan masuk untuk mengakses materi.')); ?>';
        var notAccessToastTitleLang = '<?php echo e(('Akses ditolak')); ?>';
        var notAccessToastMsgLang = '<?php echo e(('Anda tidak memiliki akses ke materi ini.')); ?>';
        var canNotTryAgainQuizToastTitleLang = '<?php echo e(('Tidak dapat dijangkau')); ?>';
        var canNotTryAgainQuizToastMsgLang = '<?php echo e(('Anda tidak dapat mengikuti kuis ini lagi.')); ?>';
        var canNotDownloadCertificateToastTitleLang = '<?php echo e(('Gagal mengunduh')); ?>';
        var canNotDownloadCertificateToastMsgLang = '<?php echo e(('Anda tidak dapat mengunduh sertifikat ini.')); ?>';
        var sessionFinishedToastTitleLang = '<?php echo e(('Sesi telah Selesai')); ?>';
        var sessionFinishedToastMsgLang = '<?php echo e(('Anda terlambat, sesi ini telah selesai.')); ?>';
        var sequenceContentErrorModalTitle = '<?php echo e(('Akses ditolak!')); ?>';
        var courseHasBoughtStatusToastTitleLang = '<?php echo e(('Pembelian gagal!')); ?>';
        var courseHasBoughtStatusToastMsgLang = '<?php echo e(('Pelatihan berhasil didaftarkan.')); ?>';
        var courseNotCapacityStatusToastTitleLang = '<?php echo e(('Permintaan gagal')); ?>';
        var courseNotCapacityStatusToastMsgLang = '<?php echo e(('Di luar kapasitas kelas!')); ?>';
        var courseHasStartedStatusToastTitleLang = '<?php echo e(('Pembelian gagal!')); ?>';
        var courseHasStartedStatusToastMsgLang = '<?php echo e(('Kelas telah dimulai')); ?>';

    </script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/comment.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/video_player_helpers.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/webinar_show.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/course/index.blade.php ENDPATH**/ ?>