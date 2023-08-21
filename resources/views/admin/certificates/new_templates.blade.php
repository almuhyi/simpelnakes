@extends('admin.layouts.app')

@push('styles_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Template baru</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Template baru</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <p class="col-6 col-lg-3">Peserta : [student] </p>

                        <p class="col-6 col-lg-3">Pelatihan : [course] </p>

                        <p class="col-6 col-lg-3">Nilai : [grade] </p>

                        <p class="col-6 col-lg-3">ID sertifikat : [certificate_id] </p>

                        <p class="col-6 col-lg-3">Tanggal : [date] </p>

                        <p class="col-6 col-lg-3">Instruktur : [instructor_name] </p>

                        <p class="col-6 col-lg-3">Durasi : [duration] </p>

                        <p class="col-6 col-lg-6">ID lainnya : [user_certificate_additional] </p>
                    </div>

                    <hr class="my-4">

                    <form method="post" action="" id="templateForm" class="form-horizontal form-bordered">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Jenis</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="">Pilih jenis</option>
                                        <option value="quiz" {{ (!empty($template) and $template->type == 'quiz') ? 'selected' : '' }}>Sertifikat kuis</option>
                                        <option value="course" {{ (!empty($template) and $template->type == 'course') ? 'selected' : '' }}>Sertifikat penyelesaian pelatihan</option>
                                    </select>
                                    <div class="invalid-feedback">@error('type') {{ $message }} @enderror</div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Judul</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ !empty($template) ? $template->title : old('title') }}">
                                    <div class="invalid-feedback">@error('title') {{ $message }} @enderror</div>
                                </div>

                                <div class="form-group">
                                    <label class="input-label">Gambar latar belakang</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text admin-file-manager " data-input="image" data-preview="holder">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="image" id="image" value="{{ !empty($template) ? $template->image : old('image') }}" class="js-certificate-image form-control @error('image') is-invalid @enderror"/>
                                        <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                    </div>
                                    <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                    <div class="text-muted text-small mt-1">1190x850 lebih disukai</div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <dov class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Position X</label>
                                    <input type="text" name="position_x" class="form-control @error('position_x') is-invalid @enderror" value="{{ !empty($template) ? $template->position_x : old('position_x') }}">
                                    <div class="invalid-feedback">@error('position_x') {{ $message }} @enderror</div>
                                </div>
                            </dov>
                            <dov class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">
                                        Position Y</label>
                                    <input type="text" name="position_y" class="form-control @error('position_y') is-invalid @enderror" value="{{ !empty($template) ? $template->position_y : old('position_y') }}">
                                    <div class="invalid-feedback">@error('position_y') {{ $message }} @enderror</div>
                                </div>
                            </dov>

                            <dov class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Font Size</label>
                                    <input type="text" name="font_size" class="form-control @error('font_size') is-invalid @enderror" value="{{ !empty($template) ? $template->font_size : old('font_size') }}">
                                    <div class="invalid-feedback">@error('font_size') {{ $message }} @enderror</div>
                                </div>
                            </dov>
                            <dov class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">
                                        Text Color</label>
                                    <input type="text" name="text_color" class="form-control @error('text_color') is-invalid @enderror" value="{{ !empty($template) ? $template->text_color : old('text_color') }}">
                                    <div class="invalid-feedback">@error('text_color') {{ $message }} @enderror</div>
                                    <div>Example: #e1e1e1</div>
                                </div>
                            </dov>
                        </div>

                        <div class="form-group ">
                            <label class="control-label" for="inputDefault">Isi</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" rows="9" name="body">{{ (!empty($template)) ? $template->body : old('body') }}</textarea>
                            <div class="invalid-feedback">@error('body') {{ $message }} @enderror</div>
                        </div>


                        <div class="form-group custom-switches-stacked">
                            <label class="custom-switch pl-0">
                                <input type="hidden" name="status" value="draft">
                                <input type="checkbox" id="status" name="status" value="publish" {{ (!empty($template) and $template->status == 'publish') ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                <span class="custom-switch-indicator"></span>
                                <label class="custom-switch-description mb-0 cursor-pointer" for="status">Aktif</label>
                            </label>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-success pull-left" id="submiter" type="button" data-action="{{ url(!empty($template) ? '/admin/certificates/templates/'. $template->id .'/update' : '/admin/certificates/templates/store') }}">Simpan</button>
                                <button class="btn btn-info pull-left" id="preview" type="button" data-action="{{ url('/admin/certificates/templates/preview') }}">Lihat</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')


    <script src="{{ asset('') }}assets/default/js/admin/certificates.min.js"></script>
@endpush
