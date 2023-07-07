@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Halaman Tambahan</div>
            </div>
        </div>


        <div class="section-body">

            <div class="d-flex align-items-center justify-content-between">
                <div class="">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/pages/{{ !empty($page) ? $page->id.'/update' : 'store' }}" method="Post">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-12 col-lg-6">

                                        @if(!empty(getGeneralSettings('content_translate')))
                                            <div class="form-group">
                                                <label class="input-label">Bahasa</label>
                                                <select name="locale" class="form-control {{ !empty($page) ? 'js-edit-content-locale' : '' }}">
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


                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                                                   value="{{ !empty($page) ? $page->name : old('name') }}" />
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>URL</label>
                                            <input type="text" name="link" class="form-control  @error('link') is-invalid @enderror"
                                                   value="{{ !empty($page) ? $page->link : old('link') }}"/>
                                            @error('link')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div class="text-muted text-small mt-1">Mulailah dengan "/" dan cukup gunakan huruf kecil. Contoh: /about jadi URL halamannya adalah yourwebsiteurl.com/pages/about</div>
                                        </div>

                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"
                                                   value="{{ !empty($page) ? $page->title : old('title') }}" placeholder="ditampilkan di header halaman"/>
                                            @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                Deskripsi Meta SEO</label>
                                            <textarea name="seo_description" class="form-control  @error('seo_description') is-invalid @enderror" rows="4">{{ !empty($page) ? $page->seo_description : old('seo_description') }}</textarea>
                                            @error('seo_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">Isi
                                    </label>
                                    <textarea id="summernote" name="content" class="summernote form-control @error('content')  is-invalid @enderror">{!! !empty($page) ? $page->content : old('content')  !!}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group custom-switches-stacked">
                                    <label class="input-label">Status:</label>
                                    <label class="custom-switch pl-0">
                                        <label class="custom-switch-description mb-0 mr-2">Draft</label>
                                        <input type="hidden" name="status" value="draft">
                                        <input type="checkbox" name="status" id="pageStatus" value="publish" {{ (!empty($page) and $page->status == 'publish') ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description mb-0 cursor-pointer" for="pageStatus">Publish</label>
                                    </label>
                                </div>

                                <div class="form-group custom-switches-stacked">
                                    <label class="input-label">
                                        Akses Robot SEO:</label>
                                    <label class="custom-switch pl-0">
                                        <label class="custom-switch-description mb-0 mr-2">Tidak mengikuti</label>
                                        <input type="hidden" name="robot" value="0">
                                        <input type="checkbox" name="robot" id="pageRobot" value="1" {{ (!empty($page) and $page->robot) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description mb-0 cursor-pointer" for="pageRobot">Mengikuti</label>
                                    </label>
                                </div>

                                <div class=" mt-4">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
@endpush
