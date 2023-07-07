@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')

    <section>

        <form action="{{ url('') }}/panel/blog/posts/{{ (!empty($post) ? $post->id.'/update' : 'store') }}" method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-12 col-md-6">

                    @if(!empty(getGeneralSettings('content_translate')) and !empty($userLanguages))
                        <div class="form-group">
                            <label class="input-label">Bahasa</label>
                            <select name="locale" class="form-control {{ !empty($post) ? 'js-edit-content-locale' : '' }}">
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
                        <label class="input-label">Judul</label>
                        <input type="text" name="title"
                               class="form-control  @error('title') is-invalid @enderror"
                               value="{{ (!empty($post) and !empty($post->translate($locale))) ? $post->translate($locale)->title : old('title') }}"
                               placeholder="Judul"/>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Kategori</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                            <option selected disabled>Pilih kategori</option>

                            @foreach($blogCategories as $blogCategory)
                                <option value="{{ $blogCategory->id }}" {{ (((!empty($post) and $post->category_id == $blogCategory->id) or (old('category_id') == $blogCategory->id)) ? 'selected="selected"' : '') }}>{{ $blogCategory->title }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Gambar sampul</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text panel-file-manager" data-input="image" data-preview="holder">
                                    <i data-feather="upload" class="text-white" width="18" height="18"></i>
                                </button>
                            </div>
                            <input type="text" name="image" id="image" value="{{ (!empty($post)) ? $post->image : old('image') }}" class="form-control @error('image') is-invalid @enderror" placeholder="350x250px lebih disukai"/>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-15">
                <label class="input-label">Deskripsi</label>
                <textarea id="summernote" name="description" class="main-summernote summernote form-control @error('description')  is-invalid @enderror" placeholder="Deskripsi">{!! (!empty($post) and !empty($post->translate($locale))) ? $post->translate($locale)->description : old('description') !!}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-15">
                <label class="input-label">Isi konten</label>
                <textarea id="contentSummernote" name="content" class="main-summernote summernote form-control @error('content')  is-invalid @enderror" placeholder="Isi konten">{!! (!empty($post) and !empty($post->translate($locale))) ? $post->translate($locale)->content : old('content')  !!}</textarea>
                @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm mt-1">Simpan</button>
        </form>

    </section>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.js"></script>
@endpush
