@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <form method="post" action="{{ url('/panel/support/store') }}">
        {{ csrf_field() }}

        <section>
            <h2 class="section-title">Pesan dukungan baru</h2>

            <div class="mt-25 rounded-sm shadow py-20 px-10 px-lg-25 bg-white">

                <div class="form-group">
                    <label class="input-label">
                        Subjek</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title')  is-invalid @enderror"/>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label d-block">Jenis</label>

                    <select name="type" id="supportType" class="form-control  @error('type')  is-invalid @enderror" data-allow-clear="false" data-search="false">
                        <option selected disabled></option>
                        <option value="course_support" @if($errors->has('webinar_id')) selected @endif>
                            dukungan pelatihan</option>
                        <option value="platform_support" @if($errors->has('department_id')) selected @endif>dukungan platform</option>
                    </select>

                    @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div id="departmentInput" class="form-group @if(!$errors->has('department_id')) d-none @endif">
                    <label class="input-label d-block">departemen</label>

                    <select name="department_id" id="departments" class="form-control select2 @error('department_id')  is-invalid @enderror" data-allow-clear="false" data-search="false">
                        <option selected disabled></option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->title }}</option>
                        @endforeach
                    </select>

                    @error('department_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div id="courseInput" class="form-group @if(!$errors->has('webinar_id')) d-none @endif">
                    <label class="input-label d-block">Pelatihan</label>
                    <select name="webinar_id" class="form-control select2 @error('webinar_id')  is-invalid @enderror">
                        <option value="" selected disabled>Pilih pelatihan</option>

                        @foreach($webinars as $webinar)
                            <option value="{{ $webinar->id }}">{{ $webinar->title }} - {{ $webinar->creator->full_name }}</option>
                        @endforeach
                    </select>
                    @error('webinar_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label d-block">Pesan</label>
                    <textarea name="message" class="form-control" rows="15">{{ old('message') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 d-flex align-items-center">
                        <div class="form-group">
                            <label class="input-label">Lampirkan file</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager" data-input="attach" data-preview="holder">
                                        <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="attach" id="attach" value="{{ old('attach') }}" class="form-control"/>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm ml-40 mt-10">Kirim pesan</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/panel/conversations.min.js"></script>
@endpush
