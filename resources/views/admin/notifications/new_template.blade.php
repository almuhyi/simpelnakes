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
                    <div class="section-title ml-0 mt-0 mb-3"><h5>Tag</h5></div>
                    <div class="row">
                        @foreach(\App\Models\NotificationTemplate::$templateKeys as $key => $value)
                            <div class="col-6 col-md-4">
                                <p>{{ $key }} : {{ $value }} </p>
                                <hr>
                            </div>
                        @endforeach
                    </div>

                    <strong class="mt-4 d-block">Anda dapat menggunakan tag data di atas dalam judul template & teks isi.</strong>

                    <form method="post" action="{{ url('') }}/admin/notifications/templates/{{ !empty($template) ? $template->id .'/update' : 'store' }}" class="form-horizontal form-bordered mt-4">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label" for="inputDefault">Judul</label>
                            <input type="text" name="title" class="form-control col-md-6 @error('title') is-invalid @enderror" value="{{ !empty($template) ? $template->title : '' }}">
                            <div class="invalid-feedback">@error('title') {{ $message }} @enderror</div>
                        </div>


                        <div class="form-group ">
                            <label class="control-label" for="inputDefault">Teks</label>
                            <textarea name="template" class="summernote form-control text-left  @error('template') is-invalid @enderror">{{ (!empty($template)) ? $template->template :'' }}</textarea>
                            <div class="invalid-feedback">@error('template') {{ $message }} @enderror</div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary " type="submit">Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="card">
        <div class="card-body">
            <div class="section-title ml-0 mt-0 mb-3"><h5>Petunjuk</h5></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">
                            Fungsi Tag Data</div>
                        <div class=" text-small font-600-bold">Tag data dapat disertakan dalam judul atau isi notifikasi. Anda dapat membuat notifikasi yang dipersonalisasi menggunakan tag data.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Fungsi Tag Data</div>
                        <div class=" text-small font-600-bold">Setelah template pemberitahuan dibuat, buka "Pengaturan/Pemberitahuan" dan tetapkan template ke proses terkait.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.js"></script>
@endpush
