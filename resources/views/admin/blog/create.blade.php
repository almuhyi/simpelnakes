@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ (!empty($post) ? 'Edit Blog' : 'Buat Blog') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Blog</div>
            </div>
        </div>

        <div class="section-body ">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <form action="{{ url('') }}/admin/blog/{{ (!empty($post) ? $post->id.'/update' : 'store') }}" method="post">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-12 col-md-6">


                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" name="title"
                                                   class="form-control  @error('title') is-invalid @enderror"
                                                   value="{{ !empty($post) ? $post->title : old('title') }}"
                                                   placeholder="Judul"/>
                                            @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mt-15 ">
                                            <label class="input-label d-block">Penulis</label>

                                            <select name="author_id" class="form-control search-user-select2"
                                                    data-placeholder="Pilih penulis"
                                                    data-search-option="except_user"
                                            >
                                                @if(!empty($post))
                                                    <option value="{{ $post->author->id }}" selected>{{ $post->author->full_name }}</option>
                                                @else
                                                    <option selected disabled>Pilih penulis</option>
                                                @endif
                                            </select>

                                            @error('teacher_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                                <option {{ !empty($trend) ? '' : 'selected' }} disabled>Pilih kategori</option>

                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ (((!empty($post) and $post->category_id == $category->id) or (old('category_id') == $category->id)) ? 'selected="selected"' : '') }}>{{ $category->title }}</option>
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
                                                    <button type="button" class="input-group-text admin-file-manager" data-input="image" data-preview="holder">
                                                        <i class="fa fa-chevron-up"></i>
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
                                    <div class="text-muted text-small mb-3">Deskripsi singkat tentang postingan blog Anda yang akan ditampilkan di kartu postingan blog (~160 Karakter).</div>
                                    <textarea id="summernote" name="description" class="summernote form-control @error('description')  is-invalid @enderror" placeholder="">{!! !empty($post) ? $post->description : old('description')  !!}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">Isi</label>
                                    <div class="text-muted text-small mb-3">Konten posting blog utama yang akan ditampilkan di halaman posting blog. Lebih dari 300 kata lebih disukai.</div>
                                    <textarea id="contentSummernote" name="content" class="summernote form-control @error('content')  is-invalid @enderror" placeholder="">{!! !empty($post) ? $post->content : old('content')  !!}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">
                                        Deskripsi Meta SEO</label>
                                    <textarea name="meta_description" rows="5" class="form-control @error('meta_description')  is-invalid @enderror" placeholder="155 - 160 karakter">{!! !empty($post) ? $post->meta_description : old('meta_description')  !!}</textarea>
                                    @error('meta_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-30  d-flex align-items-center cursor-pointer">
                                    <div class="custom-control custom-switch align-items-start">
                                        <input type="checkbox" name="enable_comment" class="custom-control-input" id="commentsSwitch" {{ (!empty($post) and !$post->enable_comment) ? '' : 'checked' }}>
                                        <label class="custom-control-label" for="commentsSwitch"></label>
                                    </div>
                                    <label for="commentsSwitch" class="mb-0">Aktifkan Komentar</label>
                                </div>

                                <div class="form-group mt-30 d-flex align-items-center cursor-pointer">
                                    <div class="custom-control custom-switch align-items-start">
                                        <input type="checkbox" name="status" class="custom-control-input" id="statusSwitch" {{ (!empty($post) and $post->status == 'pending') ? '' : 'checked' }}>
                                        <label class="custom-control-label" for="statusSwitch"></label>
                                    </div>
                                    <label for="statusSwitch" class="mb-0">Publish</label>
                                </div>

                                <button type="submit" class="btn btn-primary mt-1">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.js"></script>
@endpush
