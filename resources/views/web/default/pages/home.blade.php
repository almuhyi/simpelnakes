@extends(getTemplate() . '.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/owl-carousel2/owl.carousel.min.css">
@endpush

@section('content')

    @if (!empty($heroSectionData))

        @if (!empty($heroSectionData['has_lottie']) and $heroSectionData['has_lottie'] == '1')
            @push('scripts_bottom')
                <script src="{{ asset('') }}assets/default/vendors/lottie/lottie-player.js"></script>
            @endpush
        @endif

        <section class="slider-container  {{ $heroSection == '2' ? 'slider-hero-section2' : '' }}"
            @if (empty($heroSectionData['is_video_background'])) style="background-image: url('{{ $heroSectionData['hero_background'] }}')" @endif>

            @if ($heroSection == '1')
                @if (!empty($heroSectionData['is_video_background']))
                    <video playsinline autoplay muted loop id="homeHeroVideoBackground" class="img-cover">
                        <source src="{{ asset($heroSectionData['hero_background']) }}" type="video/mp4">
                    </video>
                @endif

                <div class="mask"></div>
            @endif

            <div class="container user-select-none">

                @if ($heroSection == '2')
                    <div class="row slider-content align-items-center hero-section2 flex-column-reverse flex-md-row">
                        <div class="col-12 col-md-7 col-lg-6">
                            <h1 class="text-secondary font-weight-bold">{{ $heroSectionData['title'] }}</h1>
                            <p class="slide-hint text-gray mt-20">{!! nl2br($heroSectionData['description']) !!}</p>

                            <form action="{{ url('/search') }}" method="get" class="d-inline-flex mt-30 mt-lg-30 w-100">
                                <div class="form-group d-flex align-items-center m-0 slider-search p-10 bg-white w-100">
                                    <input type="text" name="search" class="form-control border-0 mr-lg-50"
                                        placeholder="Cari Pelatihan" />
                                    <button type="submit" class="btn btn-primary rounded-pill">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-5 col-lg-6">
                            @if (!empty($heroSectionData['has_lottie']) and $heroSectionData['has_lottie'] == '1')
                                <lottie-player src="{{ $heroSectionData['hero_vector'] }}" background="transparent"
                                    speed="1" class="w-100" loop autoplay></lottie-player>
                            @else
                                <img src="{{ $heroSectionData['hero_vector'] }}" alt="{{ $heroSectionData['title'] }}"
                                    class="img-cover">
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center slider-content">
                        <h1>{{ $heroSectionData['title'] }}</h1>
                        <div class="row h-100 align-items-center justify-content-center text-center">
                            <div class="col-12 col-md-9 col-lg-7">
                                <p class="mt-30 slide-hint">{!! nl2br($heroSectionData['description']) !!}</p>

                                <form action="{{ url('/search') }}" method="get" class="d-inline-flex mt-30 mt-lg-50 w-100">
                                    <div class="form-group d-flex align-items-center m-0 slider-search p-10 bg-white w-100">
                                        <input type="text" name="search" class="form-control border-0 mr-lg-50"
                                            placeholder="Cari Pelatihan" />
                                        <button type="submit" class="btn btn-primary rounded-pill">Cari</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <div class="stats-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3 mt-25 mt-lg-0">
                    <div class="stats-item d-flex flex-column align-items-center text-center py-30 px-5 w-100">
                        <div class="stat-icon-box teacher">
                            <img src="{{ asset('') }}assets/default/img/stats/teacher.svg" alt="" />
                        </div>
                        <strong class="stat-number mt-10">{{ $skillfulTeachersCount }}</strong>
                        <h4 class="stat-title">Instruktur yang terampil</h4>
                        <p class="stat-desc mt-10">
                            Mulailah belajar dari instruktur berpengalaman.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mt-25 mt-lg-0">
                    <div class="stats-item d-flex flex-column align-items-center text-center py-30 px-5 w-100">
                        <div class="stat-icon-box student">
                            <img src="{{ asset('') }}assets/default/img/stats/student.svg" alt="" />
                        </div>
                        <strong class="stat-number mt-10">{{ $studentsCount }}</strong>
                        <h4 class="stat-title">Peserta Pelatihan</h4>
                        <p class="stat-desc mt-10">Daftar pelatihan dan tingkatkan keterampilan</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mt-25 mt-lg-0">
                    <div class="stats-item d-flex flex-column align-items-center text-center py-30 px-5 w-100">
                        <div class="stat-icon-box video">
                            <img src="{{ asset('') }}assets/default/img/stats/video.svg" alt="" />
                        </div>
                        <strong class="stat-number mt-10">{{ $liveClassCount }}</strong>
                        <h4 class="stat-title">Kelas Webinar</h4>
                        <p class="stat-desc mt-10">Tingkatkan keterampilan Anda dengan pelatihan webinar.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mt-25 mt-lg-0">
                    <div class="stats-item d-flex flex-column align-items-center text-center py-30 px-5 w-100">
                        <div class="stat-icon-box course">
                            <img src="{{ asset('') }}assets/default/img/stats/course.svg" alt="" />
                        </div>
                        <strong class="stat-number mt-10">{{ $offlineCourseCount }}</strong>
                        <h4 class="stat-title">Kelas Video</h4>
                        <p class="stat-desc mt-10">Belajar tanpa batasan geografis & waktu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @foreach ($homeSections as $homeSection)
        @if ($homeSection->name == \App\Models\HomeSection::$blog and !empty($blog) and !$blog->isEmpty())
            <section class="home-sections container">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="section-title">Berita</h2>
                        <p class="section-hint">#Cek berita dan artikel terbaru</p>
                    </div>

                    <a href="{{ url('/blog') }}" class="btn btn-border-white">Selengkapnya</a>
                </div>

                <div class="row mt-35">

                    @foreach ($blog as $post)
                        <div class="col-12 col-md-4 col-lg-4 mt-20 mt-lg-0">
                            @include('web.default.blog.grid-list', ['post' => $post])
                        </div>
                    @endforeach

                </div>
            </section>
        @endif



        @if (
            $homeSection->name == \App\Models\HomeSection::$trend_categories and
                !empty($trendCategories) and
                !$trendCategories->isEmpty())
            <section class="home-sections home-sections-swiper container">
                <h2 class="section-title">Profesi Pelatihan</h2>
                <p class="section-hint">#Cari pelatihan menurut profesi anda</p>

                <div class="row mt-40">

                    @foreach ($trendCategories as $trend)
                        <div class="col-6 col-md-3 col-lg-2 mt-20 mt-md-0">
                            <a href="{{ url($trend->category->getUrl()) }}">
                                <div class="trending-card d-flex flex-column align-items-center w-100">
                                    <div class="trending-image d-flex align-items-center justify-content-center w-100"
                                        style="background-color: {{ $trend->color }}">
                                        <div class="icon mb-3">
                                            <img src="{{ asset($trend->getIcon()) }}" width="10" class="img-cover"
                                                alt="{{ $trend->category->title }}">
                                        </div>
                                    </div>

                                    <div class="item-count px-10 px-lg-20 py-5 py-lg-10">
                                        {{ $trend->category->webinars_count }} Pelatihan</div>

                                    <h3>{{ $trend->category->title }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Ads Bannaer --}}
        @if (
            $homeSection->name == \App\Models\HomeSection::$full_advertising_banner and
                !empty($advertisingBanners1) and
                count($advertisingBanners1))
            <div class="home-sections container">
                <div class="row">
                    @foreach ($advertisingBanners1 as $banner1)
                        <div class="col-{{ $banner1->size }}">
                            <a href="{{ url($banner1->link) }}">
                                <img src="{{ asset($banner1->image) }}" class="img-cover rounded-sm"
                                    alt="{{ $banner1->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        @if (
            $homeSection->name == \App\Models\HomeSection::$testimonials and
                !empty($testimonials) and
                !$testimonials->isEmpty())
            <div class="position-relative testimonials-container">

                <div id="parallax1" class="ltr">
                    <div data-depth="0.2" class="gradient-box left-gradient-box"></div>
                </div>

                <section class="container home-sections home-sections-swiper">
                    <div class="text-center">
                        <h2 class="section-title">Testimoni Peserta</h2>
                        <p class="section-hint">Apa yang dikatakan oleh peserta</p>
                    </div>

                    <div class="position-relative">
                        <div class="swiper-container testimonials-swiper px-12">
                            <div class="swiper-wrapper">

                                @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div
                                            class="testimonials-card position-relative py-15 py-lg-30 px-10 px-lg-20 rounded-sm shadow bg-white text-center">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="testimonials-user-avatar">
                                                    <img src="{{ asset($testimonial->user_avatar) }}"
                                                        alt="{{ $testimonial->user_name }}"
                                                        class="img-cover rounded-circle">
                                                </div>
                                                <h4 class="font-16 font-weight-bold text-secondary mt-30">
                                                    {{ $testimonial->user_name }}</h4>
                                                <span
                                                    class="d-block font-14 text-gray">{{ $testimonial->user_bio }}</span>
                                                @include('web.default.includes.webinar.rate', [
                                                    'rate' => $testimonial->rate,
                                                    'dontShowRate' => true,
                                                ])
                                            </div>

                                            <p class="mt-25 text-gray font-14">{!! nl2br($testimonial->comment) !!}</p>

                                            <div class="bottom-gradient"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="swiper-pagination testimonials-swiper-pagination"></div>
                        </div>
                    </div>
                </section>

                <div id="parallax2" class="ltr">
                    <div data-depth="0.4" class="gradient-box right-gradient-box"></div>
                </div>

                <div id="parallax3" class="ltr">
                    <div data-depth="0.8" class="gradient-box bottom-gradient-box"></div>
                </div>
            </div>
        @endif



        @if ($homeSection->name == \App\Models\HomeSection::$find_instructors and !empty($findInstructorSection))
            <section class="home-sections home-sections-swiper container find-instructor-section position-relative">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="">
                            <h2 class="font-36 font-weight-bold text-dark">{{ $findInstructorSection['title'] ?? '' }}
                            </h2>
                            <p class="font-16 font-weight-normal text-gray mt-10">
                                {{ $findInstructorSection['description'] ?? '' }}</p>

                            <div class="mt-35 d-flex align-items-center">
                                @if (!empty($findInstructorSection['button1']))
                                    <a href="{{ url($findInstructorSection['button1']['link']) }}"
                                        class="btn btn-primary">{{ $findInstructorSection['button1']['title'] }}</a>
                                @endif

                                @if (!empty($findInstructorSection['button2']))
                                    <a href="{{ url($findInstructorSection['button2']['link']) }}"
                                        class="btn btn-outline-primary ml-15">{{ $findInstructorSection['button2']['title'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 mt-20 mt-lg-0">
                        <div class="position-relative ">
                            <img src="{{ asset($findInstructorSection['image']) }}" class="find-instructor-section-hero"
                                alt="{{ $findInstructorSection['title'] }}">
                            <img src="{{ asset('') }}assets/default/img/home/circle-4.png" class="find-instructor-section-circle"
                                alt="circle">
                            <img src="{{ asset('') }}assets/default/img/home/dot.png" class="find-instructor-section-dots"
                                alt="dots">

                            <div
                                class="example-instructor-card bg-white rounded-sm shadow-lg  p-5 p-md-15 d-flex align-items-center">
                                <div class="example-instructor-card-avatar">
                                    <img src="{{ asset('') }}assets/default/img/home/toutor_finder.svg" class="img-cover rounded-circle"
                                        alt="user name">
                                </div>

                                <div class="flex-grow-1 ml-15">
                                    <span class="font-14 font-weight-bold text-secondary d-block">Pencarian</span>
                                    <span class="text-gray font-12 font-weight-500">Cari Instruktur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif



        @if ($homeSection->name == \App\Models\HomeSection::$forum_section and !empty($forumSection))
            <section class="home-sections home-sections-swiper container find-instructor-section position-relative">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 mt-20 mt-lg-0">
                        <div class="position-relative ">
                            <img src="{{ asset($forumSection['image']) }}" class="find-instructor-section-hero"
                                alt="{{ $forumSection['title'] }}">
                            <img src="{{ asset('') }}assets/default/img/home/circle-4.png" class="find-instructor-section-circle"
                                alt="circle">
                            <img src="{{ asset('') }}assets/default/img/home/dot.png" class="find-instructor-section-dots"
                                alt="dots">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="">
                            <h2 class="font-36 font-weight-bold text-dark">{{ $forumSection['title'] ?? '' }}</h2>
                            <p class="font-16 font-weight-normal text-gray mt-10">{{ $forumSection['description'] ?? '' }}
                            </p>

                            <div class="mt-35 d-flex align-items-center">
                                @if (!empty($forumSection['button1']))
                                    <a href="{{ url($forumSection['button1']['link']) }}"
                                        class="btn btn-primary">{{ $forumSection['button1']['title'] }}</a>
                                @endif

                                @if (!empty($forumSection['button2']))
                                    <a href="{{ url($forumSection['button2']['link']) }}"
                                        class="btn btn-outline-primary ml-15">{{ $forumSection['button2']['title'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif



        {{-- Ads Bannaer --}}
        @if (
            $homeSection->name == \App\Models\HomeSection::$half_advertising_banner and
                !empty($advertisingBanners2) and
                count($advertisingBanners2))
            <div class="home-sections container">
                <div class="row">
                    @foreach ($advertisingBanners2 as $banner2)
                        <div class="col-{{ $banner2->size }}">
                            <a href="{{ url($banner2->link) }}">
                                <img src="{{ asset($banner2->image) }}" class="img-cover rounded-sm"
                                    alt="{{ $banner2->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        {{-- ./ Ads Bannaer --}}


    @endforeach
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/owl-carousel2/owl.carousel.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/parallax/parallax.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/parts/home.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/pace-loading/pace.min.js"></script>
@endpush
