@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">

                    <form method="post" action="{{ url('') }}/admin/{{ (!empty($isCourseNotice) and $isCourseNotice) ? 'course-noticeboards' : 'noticeboards' }}/{{ !empty($noticeboard) ? $noticeboard->id .'/update' : 'store' }}" class="form-horizontal form-bordered mt-4">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Judul</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ !empty($noticeboard) ? $noticeboard->title : old('title') }}">
                                    <div class="invalid-feedback">@error('title') {{ $message }} @enderror</div>
                                </div>

                                @if(!empty($isCourseNotice) and $isCourseNotice)
                                    <div class="form-group">
                                        <label class="input-label control-label">Pelatihan</label>
                                        <select name="webinar_id" class="form-control search-webinar-select2 @error('webinar_id') is-invalid @enderror">
                                            <option value="" selected disabled>Pilih pelatihan</option>

                                            @if(!empty($noticeboard) and !empty($noticeboard->webinar))
                                                <option value="{{ $noticeboard->webinar->id }}" selected>{{ $noticeboard->webinar->title }}</option>
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">@error('webinar_id') {{ $message }} @enderror</div>
                                    </div>


                                    <div class="form-group">
                                        <label class="input-label control-label">Warna</label>
                                        <select name="color" id="colorSelect" class="form-control @error('color') is-invalid @enderror">
                                            <option value="" selected disabled>Pilih warna</option>

                                            @foreach(\App\Models\CourseNoticeboard::$colors as $color)
                                                <option value="{{ $color }}" @if(!empty($noticeboard) and $noticeboard->color == $color) selected @endif>{{ $color }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">@error('color') {{ $message }} @enderror</div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="control-label">Jenis</label>
                                        <select name="type" id="typeSelect" class="form-control @error('type') is-invalid @enderror">
                                            <option value="" selected disabled></option>

                                            <option value="all" @if(!empty($noticeboard) and $noticeboard->type == 'all') selected @endif>Semua</option>
                                            @foreach(\App\Models\Noticeboard::$adminTypes as $type)
                                                <option value="{{ $type }}" @if(!empty($noticeboard) and $noticeboard->type == $type) selected @endif>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">@error('type') {{ $message }} @enderror</div>
                                        <div class="text-muted text-small mt-1">Pemberitahuan akan ditampilkan di papan pengumuman jenis pengguna ini.</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Pesan</label>
                            <textarea name="message" class="summernote form-control text-left  @error('message') is-invalid @enderror">{{ (!empty($noticeboard)) ? $noticeboard->message :'' }}</textarea>
                            <div class="invalid-feedback">@error('message') {{ $message }} @enderror</div>
                        </div>


                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary" type="submit">Kirim notifikasi</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.js"></script>
@endpush
