@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sertifikat Penyelesaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Sertifikat Penyelesaian</div>
            </div>
        </div>

        <div class="section-body">
            <section class="card">
                <div class="card-body">
                    <form action="/admin/certificates/course-competition" method="get" class="row mb-0">

                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="input-label d-block">Pelatihan</label>
                                <select name="webinars_ids[]" multiple="multiple" class="form-control search-webinar-select2"
                                        data-placeholder="Cari pelatihan">
                                    @if(!empty($webinars))
                                        @foreach($webinars as $webinar)
                                            <option value="{{ $webinar->id }}"
                                                    selected="selected">{{ $webinar ? $webinar->title : ''}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Instruktur</label>
                                <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role" class="form-control search-user-select2"
                                        data-placeholder="Search teachers">

                                    @if(!empty($teachers) and $teachers->count() > 0)
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" selected>{{ $teacher->full_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Peserta</label>
                                <select name="student_ids[]" multiple="multiple" data-search-option="just_student_role" class="form-control search-user-select2"
                                        data-placeholder="Search students">

                                    @if(!empty($students) and $students->count() > 0)
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" selected>{{ $student->full_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary w-100">Lihat hasil</button>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>No</th>
                                        <th class="text-left">Judul</th>
                                        <th class="text-left">Peserta</th>
                                        <th class="text-left">Instruktur</th>
                                        <th class="text-center">Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @foreach($certificates as $certificate)
                                        <tr>
                                            <td class="text-center">{{ $certificate->id }}</td>
                                            <td class="text-left">
                                                <span>{{ $certificate->webinar->title }}</span>
                                            </td>
                                            <td class="text-left">{{ $certificate->student->full_name }}</td>
                                            <td class="text-left">{{ $certificate->webinar->teacher->full_name }}</td>

                                            <td class="text-center">{{ dateTimeFormat($certificate->created_at, 'j M Y') }}</td>

                                            <td>
                                                <a href="/admin/certificates/{{ $certificate->id }}/download" target="_blank" class="btn-transparent text-primary" data-toggle="tooltip" title="Unduh sertifikat">
                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $certificates->appends(request()->input())->links('vendor.pagination.bootstrap-4')  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

