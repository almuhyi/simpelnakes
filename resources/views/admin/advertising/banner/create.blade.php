@extends('admin.layouts.app')

@push('styles_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle}}</div>
            </div>
        </div>


        <div class="section-body">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6">
                            <form action="{{ url('') }}/admin/advertising/banners/{{ !empty($banner) ? $banner->id.'/update' : 'store' }}" method="Post">
                                {{ csrf_field() }}


                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="title"
                                           class="form-control  @error('title') is-invalid @enderror"
                                           value="{{ !empty($banner) ? $banner->title : old('title') }}"/>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Posisi</label>
                                    <select name="position" class="form-control @error('position') is-invalid @enderror">
                                        <option selected disabled>Posisi</option>
                                        @foreach(\App\Models\AdvertisingBanner::$positions as $position)
                                            <option value="{{ $position }}" @if(!empty($banner) and $banner->position == $position) selected @endif>{{ $position }}</option>
                                        @endforeach
                                    </select>
                                    @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">Gambar</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text admin-file-manager" data-input="image" data-preview="holder">
                                                <i class="fa fa-chevron-up"></i>
                                            </button>
                                        </div>

                                        <input type="text" name="image" id="image" value="{{ !empty($banner->image) ? $banner->image : old('image') }}" class="form-control @error('image') is-invalid @enderror"/>
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text admin-file-view" data-input="image">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>

                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Ukuran gambar</label>
                                    <select name="size" class="form-control @error('size') is-invalid @enderror">
                                        <option selected disabled>Ukuran gambar</option>
                                        @foreach(\App\Models\AdvertisingBanner::$size as $size => $value)
                                            <option value="{{ $size }}" @if(!empty($banner) and $banner->size == $size) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name="link"
                                           class="form-control  @error('link') is-invalid @enderror"
                                           value="{{ !empty($banner) ? $banner->link : old('link') }}"/>
                                    @error('link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group custom-switches-stacked">
                                    <label class="custom-switch pl-0">
                                        <input type="hidden" name="published" value="0">
                                        <input type="checkbox" name="published" id="published" value="1" {{ (!empty($banner) and $banner->published) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description mb-0 cursor-pointer" for="published">Publish</label>
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
