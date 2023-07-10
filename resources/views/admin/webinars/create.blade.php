@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/bootstrap-tagsinput/bootstrap-tagsinput.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.css">
    <link href="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.css"/>
    <style>
        .bootstrap-timepicker-widget table td input {
            width: 35px !important;
        }

        .select2-container {
            z-index: 1212 !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($webinar) ?'Edit': 'Buat' }} Pelatihan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ url('/admin/webinars') }}">Pelatihan</a>
                </div>
                <div class="breadcrumb-item">{{!empty($webinar) ?'Edit': 'Buat' }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" action="{{ url('') }}/admin/webinars/{{ !empty($webinar) ? $webinar->id.'/update' : 'store' }}" id="webinarForm" class="webinar-form">
                                {{ csrf_field() }}
                                <section>
                                    <h2 class="section-title after-line">Informasi Awal</h2>

                                    <div class="row">
                                        <div class="col-12 col-md-5">

                                            @if(!empty(getGeneralSettings('content_translate')))
                                                <div class="form-group">
                                                    <label class="input-label">Bahasa</label>
                                                    <select name="locale" class="form-control {{ !empty($webinar) ? 'js-edit-content-locale' : '' }}">
                                                        @foreach($userLanguages as $lang => $language)
                                                            <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('locale')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            @else
                                                <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
                                            @endif

                                            <div class="form-group mt-15 ">
                                                <label class="input-label d-block">Tipe Pelatihan</label>

                                                <select name="type" class="custom-select @error('type')  is-invalid @enderror">
                                                    <option value="webinar" @if((!empty($webinar) and $webinar->isWebinar()) or old('type') == \App\Models\Webinar::$webinar) selected @endif>Pelatihan webinar</option>
                                                    <option value="course" @if((!empty($webinar) and $webinar->isCourse()) or old('type') == \App\Models\Webinar::$course) selected @endif>Pelatihan Video</option>
                                                    <option value="text_lesson" @if((!empty($webinar) and $webinar->isTextCourse()) or old('type') == \App\Models\Webinar::$textLesson) selected @endif>Pelatihan Text</option>
                                                </select>

                                                @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label">Judul Pelatihan</label>
                                                <input type="text" name="title" value="{{ !empty($webinar) ? $webinar->title : old('title') }}" class="form-control @error('title')  is-invalid @enderror" placeholder=""/>
                                                @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label">Poin / Nilai</label>
                                                <input type="number" name="points" value="{{ !empty($webinar) ? $webinar->points : old('points') }}" class="form-control @error('points')  is-invalid @enderror" placeholder="Kosong berarti mode ini tidak aktif"/>
                                                @error('points')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label">URL Pelatihan</label>
                                                <input type="text" name="slug" value="{{ !empty($webinar) ? $webinar->slug : old('slug') }}" class="form-control @error('slug')  is-invalid @enderror" placeholder=""/>
                                                <div class="text-muted text-small mt-1">Url pelatihan harus unik, gunakan tanpa spasi. Ini akan dihasilkan secara default; Anda dapat menggunakan default.</div>
                                                @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            @if(!empty($webinar) and $webinar->creator->isOrganization())
                                                <div class="form-group mt-15 ">
                                                    <label class="input-label d-block">Organisasi</label>

                                                    <select class="form-control" disabled readonly data-placeholder="Cari instruktur">
                                                        <option selected>{{ $webinar->creator->full_name }}</option>
                                                    </select>
                                                </div>
                                            @endif


                                            <div class="form-group mt-15 ">
                                                <label class="input-label d-block">Pilih Instruktur</label>

                                                <select name="teacher_id" data-search-option="except_user" class="form-control search-user-select2"
                                                        data-placeholder="Pilih Instruktur"
                                                >
                                                    @if(!empty($webinar))
                                                        <option value="{{ $webinar->teacher->id }}" selected>{{ $webinar->teacher->full_name }}</option>
                                                    @else
                                                        <option selected disabled>Pilih Instruktur</option>
                                                    @endif
                                                </select>

                                                @error('teacher_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>


                                            <div class="form-group mt-15">
                                                <label class="input-label">Deskripsi Meta SEO</label>
                                                <input type="text" name="seo_description" value="{{ !empty($webinar) ? $webinar->seo_description : old('seo_description') }}" class="form-control @error('seo_description')  is-invalid @enderror"/>
                                                <div class="text-muted text-small mt-1">
                                                    Akan ditampilkan di halaman hasil mesin pencari. 155~160 Karakter lebih disukai.</div>
                                                @error('seo_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label">Thumbnail</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="input-group-text admin-file-manager" data-input="thumbnail" data-preview="holder">
                                                            <i class="fa fa-upload"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="thumbnail" id="thumbnail" value="{{ !empty($webinar) ? $webinar->thumbnail : old('thumbnail') }}" class="form-control @error('thumbnail')  is-invalid @enderror"/>
                                                    <div class="input-group-append">
                                                        <button type="button" class="input-group-text admin-file-view" data-input="thumbnail">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('thumbnail')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group mt-15">
                                                <label class="input-label">Cover Gambar</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="input-group-text admin-file-manager" data-input="cover_image" data-preview="holder">
                                                            <i class="fa fa-upload"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="image_cover" id="cover_image" value="{{ !empty($webinar) ? $webinar->image_cover : old('image_cover') }}" class="form-control @error('image_cover')  is-invalid @enderror"/>
                                                    <div class="input-group-append">
                                                        <button type="button" class="input-group-text admin-file-view" data-input="cover_image">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('image_cover')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mt-25">
                                                <label class="input-label">Demo Video (
                                                    Opsional)</label>


                                                <div class="">
                                                    <label class="input-label font-12">Sumber</label>
                                                    <select name="video_demo_source"
                                                            class="js-video-demo-source form-control"
                                                    >
                                                        @foreach(\App\Models\Webinar::$videoDemoSource as $source)
                                                            <option value="{{ $source }}" @if(!empty($webinar) and $webinar->video_demo_source == $source) selected @endif>{{ $source }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group mt-0">
                                                <label class="input-label font-12">Path</label>
                                                <div class="input-group js-video-demo-path-input">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="js-video-demo-path-upload input-group-text admin-file-manager {{ (empty($webinar) or empty($webinar->video_demo_source) or $webinar->video_demo_source == 'upload') ? '' : 'd-none' }}" data-input="demo_video" data-preview="holder">
                                                            <i class="fa fa-upload"></i>
                                                        </button>

                                                        <button type="button" class="js-video-demo-path-links rounded-left input-group-text input-group-text-rounded-left  {{ (empty($webinar) or empty($webinar->video_demo_source) or $webinar->video_demo_source == 'upload') ? 'd-none' : '' }}">
                                                            <i class="fa fa-link"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="video_demo" id="demo_video" value="{{ !empty($webinar) ? $webinar->video_demo : old('video_demo') }}" class="form-control @error('video_demo')  is-invalid @enderror"/>
                                                    @error('video_demo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mt-15">
                                                <label class="input-label">Deskripsi</label>
                                                <textarea id="summernote" name="description" class="form-control @error('description')  is-invalid @enderror" placeholder="Minimal 300 kata, HTML dan gambar didukung">{!! !empty($webinar) ? $webinar->description : old('description')  !!}</textarea>
                                                @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="mt-3">
                                    <h2 class="section-title after-line">Informasi Tambahan</h2>
                                    <div class="row">
                                        <div class="col-12 col-md-6">

                                            @if(empty($webinar) or (!empty($webinar) and $webinar->isWebinar()))

                                                <div class="form-group mt-15 js-capacity {{ (!empty(old('type')) and old('type') != \App\Models\Webinar::$webinar) ? 'd-none' : '' }}">
                                                    <label class="input-label">Kapasitas</label>
                                                    <input type="number" name="capacity" value="{{ !empty($webinar) ? $webinar->capacity : old('capacity') }}" class="form-control @error('capacity')  is-invalid @enderror"/>
                                                    @error('capacity')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            @endif

                                            <div class="row mt-15">
                                                @if(empty($webinar) or (!empty($webinar) and $webinar->isWebinar()))
                                                    <div class="col-12 col-md-6 js-start_date {{ (!empty(old('type')) and old('type') != \App\Models\Webinar::$webinar) ? 'd-none' : '' }}">
                                                        <div class="form-group">
                                                            <label class="input-label">Tanggal Mulai</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="dateInputGroupPrepend">
                                                                        <i class="fa fa-calendar-alt "></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" name="start_date" value="{{ (!empty($webinar) and $webinar->start_date) ? dateTimeFormat($webinar->start_date, 'Y-m-d H:i', false, false, $webinar->timezone) : old('start_date') }}" class="form-control @error('start_date')  is-invalid @enderror datetimepicker" aria-describedby="dateInputGroupPrepend"/>
                                                                @error('start_date')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="input-label">Durasi (Menit)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="timeInputGroupPrepend">
                                                                    <i class="fa fa-clock"></i>
                                                                </span>
                                                            </div>


                                                            <input type="number" name="duration" value="{{ !empty($webinar) ? $webinar->duration : old('duration') }}" class="form-control @error('duration')  is-invalid @enderror"/>
                                                            @error('duration')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if(getFeaturesSettings('timezone_in_create_webinar'))
                                                @php
                                                    $selectedTimezone = getGeneralSettings('default_time_zone');

                                                    if (!empty($webinar) and !empty($webinar->timezone)) {
                                                        $selectedTimezone = $webinar->timezone;
                                                    }
                                                @endphp

                                                <div class="form-group">
                                                    <label class="input-label">Zona Waktu</label>
                                                    <select name="timezone" class="form-control select2" data-allow-clear="false">
                                                        @foreach(getListOfTimezones() as $timezone)
                                                            <option value="{{ $timezone }}" @if($selectedTimezone == $timezone) selected @endif>{{ $timezone }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('timezone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            @endif

                                            @if(!empty($webinar) and $webinar->creator->isOrganization())
                                                <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                    <label class="" for="privateSwitch">Pribadi</label>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="private" class="custom-control-input" id="privateSwitch" {{ (!empty($webinar) and $webinar->private) ? 'checked' :  '' }}>
                                                        <label class="custom-control-label" for="privateSwitch"></label>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                <label class="" for="supportSwitch">Bantuan</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="support" class="custom-control-input" id="supportSwitch" {{ !empty($webinar) && $webinar->support ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="supportSwitch"></label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                <label class="" for="includeCertificateSwitch">Sertifikat Penyelesaian</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="certificate" class="custom-control-input" id="includeCertificateSwitch" {{ !empty($webinar) && $webinar->certificate ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="includeCertificateSwitch"></label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                <label class="cursor-pointer" for="downloadableSwitch">Dapat diunduh</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="downloadable" class="custom-control-input" id="downloadableSwitch" {{ !empty($webinar) && $webinar->downloadable ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="downloadableSwitch"></label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                <label class="" for="partnerInstructorSwitch">Instruktur Mitra</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="partner_instructor" class="custom-control-input" id="partnerInstructorSwitch" {{ !empty($webinar) && $webinar->partner_instructor ? 'checked' : ''  }}>
                                                    <label class="custom-control-label" for="partnerInstructorSwitch"></label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                <label class="" for="forumSwitch">Forum Pelatihan</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="forum" class="custom-control-input" id="forumSwitch" {{ !empty($webinar) && $webinar->forum ? 'checked' : ''  }}>
                                                    <label class="custom-control-label" for="forumSwitch"></label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                <label class="" for="subscribeSwitch">Langganan</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="subscribe" class="custom-control-input" id="subscribeSwitch" {{ !empty($webinar) && $webinar->subscribe ? 'checked' : ''  }}>
                                                    <label class="custom-control-label" for="subscribeSwitch"></label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label">Periode Akses (hari)</label>
                                                <input type="text" name="access_days" value="{{ !empty($webinar) ? $webinar->access_days : old('access_days') }}" class="form-control @error('access_days')  is-invalid @enderror"/>
                                                @error('access_days')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <p class="mt-1">- Pengguna harus membeli kembali setelah periode akses pelatihan berakhir.</p>
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label">Harga</label>
                                                <input type="text" name="price" value="{{ !empty($webinar) ? $webinar->price : old('price') }}" class="form-control @error('price')  is-invalid @enderror" placeholder="Input 0 untuk Gratis"/>
                                                @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div id="partnerInstructorInput" class="form-group mt-15 {{ !empty($webinar) && $webinar->partner_instructor ? '' : 'd-none' }}">
                                                <label class="input-label d-block">Pilih instruktur mitra</label>

                                                <select name="partners[]" multiple data-search-option="just_teacher_role" class="form-control search-user-select22"
                                                        data-placeholder="Cari Instruktur"
                                                >
                                                    @if(!empty($webinarPartnerTeacher))
                                                        @foreach($webinarPartnerTeacher as $partner)
                                                            @if(!empty($partner) and $partner->teacher)
                                                                <option value="{{ $partner->teacher->id }}" selected>{{ $partner->teacher->full_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option selected disabled>Cari Instruktur}</option>
                                                    @endif
                                                </select>

                                                <div class="text-muted text-small mt-1">Instruktur mitra akan memiliki akses ke konten pelatihan dan profil mereka akan ditampilkan di halaman pelatihan.</div>
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label d-block">tags</label>
                                                <input type="text" name="tags" data-max-tag="5" value="{{ !empty($webinar) ? implode(',',$webinarTags) : '' }}" class="form-control inputtags" placeholder="ketik nama tag dan tekan enter (Maksimal : 5)"/>
                                            </div>


                                            <div class="form-group mt-15">
                                                <label class="input-label">Kategori</label>

                                                <select id="categories" class="custom-select @error('category_id')  is-invalid @enderror" name="category_id" required>
                                                    <option {{ !empty($webinar) ? '' : 'selected' }} disabled>Pilih Kategori</option>
                                                    @foreach($categories as $category)
                                                        @if(!empty($category->subCategories) and count($category->subCategories))
                                                            <optgroup label="{{  $category->title }}">
                                                                @foreach($category->subCategories as $subCategory)
                                                                    <option value="{{ $subCategory->id }}" {{ (!empty($webinar) and $webinar->category_id == $subCategory->id) ? 'selected' : '' }}>{{ $subCategory->title }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @else
                                                            <option value="{{ $category->id }}" {{ (!empty($webinar) and $webinar->category_id == $category->id) ? 'selected' : '' }}>{{ $category->title }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group mt-15 {{ (!empty($webinarCategoryFilters) and count($webinarCategoryFilters)) ? '' : 'd-none' }}" id="categoriesFiltersContainer">
                                        <span class="input-label d-block">Filter Kategori</span>
                                        <div id="categoriesFiltersCard" class="row mt-3">

                                            @if(!empty($webinarCategoryFilters) and count($webinarCategoryFilters))
                                                @foreach($webinarCategoryFilters as $filter)
                                                    <div class="col-12 col-md-3">
                                                        <div class="webinar-category-filters">
                                                            <strong class="category-filter-title d-block">{{ $filter->title }}</strong>
                                                            <div class="py-10"></div>

                                                            @foreach($filter->options as $option)
                                                                <div class="form-group mt-3 d-flex align-items-center justify-content-between">
                                                                    <label class="text-gray font-14" for="filterOptions{{ $option->id }}">{{ $option->title }}</label>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="filters[]" value="{{ $option->id }}" {{ ((!empty($webinarFilterOptions) && in_array($option->id,$webinarFilterOptions)) ? 'checked' : '') }} class="custom-control-input" id="filterOptions{{ $option->id }}">
                                                                        <label class="custom-control-label" for="filterOptions{{ $option->id }}"></label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </section>

                                @if(!empty($webinar))
                                    {{-- <section class="mt-30">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="section-title after-line">Paket Harga</h2>
                                            <button id="webinarAddTicket" type="button" class="btn btn-primary btn-sm mt-3">Tambah paket harga</button>
                                        </div>

                                        <div class="row mt-10">
                                            <div class="col-12">

                                                @if(!empty($tickets) and !$tickets->isEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table table-striped text-center font-14">

                                                            <tr>
                                                                <th>Judul</th>
                                                                <th>Diskon</th>
                                                                <th>Kapasitas</th>
                                                                <th>Tanggal</th>
                                                                <th></th>
                                                            </tr>

                                                            @foreach($tickets as $ticket)
                                                                <tr>
                                                                    <th scope="row">{{ $ticket->title }}</th>
                                                                    <td>{{ $ticket->discount }}%</td>
                                                                    <td>{{ $ticket->capacity }}</td>
                                                                    <td>{{ dateTimeFormat($ticket->start_date,'j F Y') }} - {{ (new DateTime())->setTimestamp($ticket->end_date)->format('j F Y') }}</td>
                                                                    <td>
                                                                        <button type="button" data-ticket-id="{{ $ticket->id }}" data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}" class="edit-ticket btn-transparent text-primary mt-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>

                                                                        @include('admin.includes.delete_button',['url' => '/admin/tickets/'. $ticket->id .'/delete', 'btnClass' => ' mt-1'])
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                @else
                                                    @include('admin.includes.no-result',[
                                                        'file_name' => 'ticket.png',
                                                        'title' => 'Tidak ada paket harga!',
                                                        'hint' => 'Dengan membuat rencana harga, Anda dapat menambahkan waktu dan harga yang bergantung pada kapasitas untuk pelatihan Anda.',
                                                    ])
                                                @endif
                                            </div>
                                        </div>
                                    </section> --}}


                                    @include('admin.webinars.create_includes.contents')


                                    <section class="mt-30">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="section-title after-line">Prasyarat</h2>
                                            <button id="webinarAddPrerequisites" type="button" class="btn btn-primary btn-sm mt-3">Tambah prasyarat</button>
                                        </div>

                                        <div class="row mt-10">
                                            <div class="col-12">
                                                @if(!empty($prerequisites) and !$prerequisites->isEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table table-striped text-center font-14">

                                                            <tr>
                                                                <th>Judul</th>
                                                                <th class="text-left">Instruktur</th>
                                                                <th>Harga</th>
                                                                <th>Tanggal publish</th>
                                                                <th>Diharuskan</th>
                                                                <th></th>
                                                            </tr>

                                                            @foreach($prerequisites as $prerequisite)
                                                                @if(!empty($prerequisite->prerequisiteWebinar->title))
                                                                    <tr>
                                                                        <th>{{ $prerequisite->prerequisiteWebinar->title }}</th>
                                                                        <td class="text-left">{{ $prerequisite->prerequisiteWebinar->teacher->full_name }}</td>
                                                                        <td>{{  addCurrencyToPrice(handlePriceFormat($prerequisite->prerequisiteWebinar->price)) }}</td>
                                                                        <td>{{ dateTimeFormat($prerequisite->prerequisiteWebinar->created_at,'j F Y | H:i') }}</td>
                                                                        <td>{{ $prerequisite->required ? "Ya" : 'Tidak' }}</td>

                                                                        <td>
                                                                            <button type="button" data-prerequisite-id="{{ $prerequisite->id }}" data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}" class="edit-prerequisite btn-transparent text-primary mt-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>

                                                                            @include('admin.includes.delete_button',['url' => '/admin/prerequisites/'. $prerequisite->id .'/delete', 'btnClass' => ' mt-1'])
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                @else
                                                    @include('admin.includes.no-result',[
                                                        'file_name' => 'comment.png',
                                                        'title' => 'Tidak ada prasyarat yang ditentukan!',
                                                        'hint' => 'Anda dapat membuat prasyarat yang diharuskan atau disarankan bagi peserta untuk belajar lebih baik.',
                                                    ])
                                                @endif
                                            </div>
                                        </div>
                                    </section>

                                    <section class="mt-30">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="section-title after-line">FAQ</h2>
                                            <button id="webinarAddFAQ" type="button" class="btn btn-primary btn-sm mt-3">Tambah FAQ</button>
                                        </div>

                                        <div class="row mt-10">
                                            <div class="col-12">
                                                @if(!empty($faqs) and !$faqs->isEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table table-striped text-center font-14">

                                                            <tr>
                                                                <th>Pertanyaan</th>
                                                                <th>Jawaban</th>
                                                                <th></th>
                                                            </tr>

                                                            @foreach($faqs as $faq)
                                                                <tr>
                                                                    <th>{{ $faq->title }}</th>
                                                                    <td>
                                                                        <button type="button" class="js-get-faq-description btn btn-sm btn-gray200">Lihat</button>
                                                                        <input type="hidden" value="{{ $faq->answer }}"/>
                                                                    </td>

                                                                    <td class="text-right">
                                                                        <button type="button" data-faq-id="{{ $faq->id }}" data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}" class="edit-faq btn-transparent text-primary mt-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>

                                                                        @include('admin.includes.delete_button',['url' => '/admin/faqs/'. $faq->id .'/delete', 'btnClass' => ' mt-1'])
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                @else
                                                    @include('admin.includes.no-result',[
                                                        'file_name' => 'faq.png',
                                                        'title' => 'Tidak ada FAQ yang ditentukan!',
                                                        'hint' => 'Dengan membuat FAQ, Anda akan membantu pengguna mengetahui lebih banyak tentang pelatihan Anda.',
                                                    ])
                                                @endif
                                            </div>
                                        </div>
                                    </section>

                                    @foreach(\App\Models\WebinarExtraDescription::$types as $webinarExtraDescriptionType)
                                        <section class="mt-30">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h2 class="section-title after-line">{{ $webinarExtraDescriptionType }}</h2>
                                                <button id="add_new_{{ $webinarExtraDescriptionType }}" type="button" class="btn btn-primary btn-sm mt-3">{{ $webinarExtraDescriptionType }}</button>
                                            </div>

                                            @php
                                                $webinarExtraDescriptionValues = $webinar->webinarExtraDescription->where('type',$webinarExtraDescriptionType);
                                            @endphp

                                            <div class="row mt-10">
                                                <div class="col-12">
                                                    @if(!empty($webinarExtraDescriptionValues) and count($webinarExtraDescriptionValues))
                                                        <div class="table-responsive">
                                                            <table class="table table-striped text-center font-14">

                                                                <tr>
                                                                    @if($webinarExtraDescriptionType == \App\Models\WebinarExtraDescription::$COMPANY_LOGOS)
                                                                        <th>Icon</th>
                                                                    @else
                                                                        <th>Judul</th>
                                                                    @endif
                                                                    <th></th>
                                                                </tr>

                                                                @foreach($webinarExtraDescriptionValues as $extraDescription)
                                                                    <tr>
                                                                        @if($webinarExtraDescriptionType == \App\Models\WebinarExtraDescription::$COMPANY_LOGOS)
                                                                            <td>
                                                                                <img src="{{ asset($extraDescription->value) }}" class="webinar-extra-description-company-logos" alt="">
                                                                            </td>
                                                                        @else
                                                                            <td>{{ $extraDescription->value }}</td>
                                                                        @endif

                                                                        <td class="text-right">
                                                                            <button type="button" data-item-id="{{ $extraDescription->id }}" data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}" class="edit-extraDescription btn-transparent text-primary mt-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>

                                                                            @include('admin.includes.delete_button',['url' => '/admin/webinar-extra-description/'. $extraDescription->id .'/delete', 'btnClass' => ' mt-1'])
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </table>
                                                        </div>
                                                    @else
                                                        @include('admin.includes.no-result',[
                                                             'file_name' => 'faq.png',
                                                             'title' => ("{$webinarExtraDescriptionType}"),
                                                             'hint' => ("{$webinarExtraDescriptionType}"),
                                                        ])
                                                    @endif
                                                </div>
                                            </div>
                                        </section>
                                    @endforeach

                                    <section class="mt-30">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="section-title after-line">Sertifikat kuis</h2>
                                            <button id="webinarAddQuiz" type="button" class="btn btn-primary btn-sm mt-3">Tambah kuis</button>
                                        </div>
                                        <div class="row mt-10">
                                            <div class="col-12">
                                                @if(!empty($webinarQuizzes) and !$webinarQuizzes->isEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table table-striped text-center font-14">

                                                            <tr>
                                                                <th>Judul</th>
                                                                <th>Pertanyaan</th>
                                                                <th>Total nilai</th>
                                                                <th>Nilai lulus</th>
                                                                <th>Sertifikat</th>
                                                                <th></th>
                                                            </tr>

                                                            @foreach($webinarQuizzes as $webinarQuiz)
                                                                <tr>
                                                                    <th>{{ $webinarQuiz->title }}</th>
                                                                    <td>{{ $webinarQuiz->quizQuestions->count() }}</td>
                                                                    <td>{{ $webinarQuiz->quizQuestions->sum('grade') }}</td>
                                                                    <td>{{ $webinarQuiz->pass_mark }}</td>
                                                                    <td>{{ $webinarQuiz->certificate ? 'Ya' : 'No' }}</td>
                                                                    <td>
                                                                        <button type="button" data-webinar-quiz-id="{{ $webinarQuiz->id }}" data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}" class="edit-webinar-quiz btn-transparent text-primary mt-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>

                                                                        @include('admin.includes.delete_button',['url' => '/admin/webinar-quiz/'. $webinarQuiz->id .'/delete', 'btnClass' => ' mt-1'])
                                                                    </td>
                                                                    @endforeach
                                                                </tr>

                                                        </table>
                                                    </div>
                                                @else
                                                    @include('admin.includes.no-result',[
                                                        'file_name' => 'cert.png',
                                                        'title' => 'Tidak ada Kuis yang dipilih untuk pelatihan ini.',
                                                        'hint' => 'Dengan membuat kuis, Anda dapat mengevaluasi peserta dan memberikan sertifikat kepada mereka.',
                                                    ])
                                                @endif
                                            </div>
                                        </div>
                                    </section>
                                @endif

                                <section class="mt-3">
                                    <h2 class="section-title after-line">Pesan untuk peninjau</h2>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mt-15">
                                                <textarea name="message_for_reviewer" rows="10" class="form-control">{{ (!empty($webinar) && $webinar->message_for_reviewer) ? $webinar->message_for_reviewer : old('message_for_reviewer') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <input type="hidden" name="draft" value="no" id="forDraft"/>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" id="saveAndPublish" class="btn btn-success">{{ !empty($webinar) ? 'Simpan dan publis' : 'Simpan dan lanjutkan' }}</button>

                                        @if(!empty($webinar))
                                            <button type="button" id="saveReject" class="btn btn-warning">Tolak</button>

                                            @include('admin.includes.delete_button',[
                                                    'url' => '/admin/webinars/'. $webinar->id .'/delete',
                                                    'btnText' => 'Hapus',
                                                    'hideDefaultClass' => true,
                                                    'btnClass' => 'btn btn-danger'
                                                    ])
                                        @endif
                                    </div>
                                </div>
                            </form>


                            @include('admin.webinars.modals.prerequisites')
                            @include('admin.webinars.modals.quizzes')
                            @include('admin.webinars.modals.ticket')
                            @include('admin.webinars.modals.chapter')
                            @include('admin.webinars.modals.session')
                            @include('admin.webinars.modals.file')
                            @include('admin.webinars.modals.interactive_file')
                            @include('admin.webinars.modals.faq')
                            @include('admin.webinars.modals.testLesson')
                            @include('admin.webinars.modals.assignment')
                            @include('admin.webinars.modals.extra_description')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script>
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
        var titleLang = '{{ ('Judul') }}';
        var zoomJwtTokenInvalid = '{{ ('Kredensial Zoom instruktur tidak valid!') }}';
        var editChapterLang = '{{ ('Edit bagian') }}';
        var requestFailedLang = '{{ ('Permintaan gagal') }}';
        var thisLiveHasEndedLang = '{{ ('Live ini telah berakhir.') }}';
        var quizzesSectionLang = '{{ ('Tidak ada Bagian') }}';
        var filePathPlaceHolderBySource = {
            upload: '{{ ('Unggah file dari PC Anda') }}',
            youtube: '{{ ('Tempel tautan Youtube') }}',
            vimeo: '{{ ('Tempel tautan Youtube') }}',
            external_link: '{{ ('Tempel tautan eksternal') }}',
            google_drive: '{{ ('Tautan pratinjau Drive (Sematan) dimulai dengan tag iframe') }}',
            dropbox: '{{ ('Tempel tautan dropbox') }}',
            iframe: '{{ ('Rekatkan seluruh kode iframe') }}',
            s3: '{{ ('Unggah file dari PC Anda ke S3') }}',
        }
    </script>

    <script src="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/feather-icons/dist/feather.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/moment.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.js"></script>

    <script src="{{ asset('') }}assets/default/js/admin/quiz.min.js"></script>
    <script src="{{ asset('') }}assets/admin/js/webinar.min.js"></script>
@endpush
