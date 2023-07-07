@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Daftar Kuis</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Kuis</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total kuis</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalQuizzes }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-clipboard-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kuis aktif</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalActiveQuizzes }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total peserta</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalStudents }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah yang Lulus</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalPassedStudents }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form action="/admin/quizzes" method="get" class="row mb-0">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Cari</label>
                                <input type="text" class="form-control" name="title" value="{{ request()->get('title') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Tanggal mulai</label>
                                <div class="input-group">
                                    <input type="date" id="fsdate" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Tanggal akhir</label>
                                <div class="input-group">
                                    <input type="date" id="lsdate" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Filter</label>
                                <select name="sort" data-plugin-selectTwo class="form-control populate">
                                    <option value="">Jenis filter</option>
                                    <option value="have_certificate" @if(request()->get('sort') == 'have_certificate') selected @endif>Kuis dengan sertifikat</option>
                                    <option value="students_count_asc" @if(request()->get('sort') == 'students_count_asc') selected @endif>Peserta ASC</option>
                                    <option value="students_count_desc" @if(request()->get('sort') == 'students_count_desc') selected @endif>Peserta DESC</option>
                                    <option value="passed_count_asc" @if(request()->get('sort') == 'passed_count_asc') selected @endif>Lulus ASC</option>
                                    <option value="passed_count_desc" @if(request()->get('sort') == 'passed_count_desc') selected @endif>Lulus DESC</option>
                                    <option value="grade_avg_asc" @if(request()->get('sort') == 'grade_avg_asc') selected @endif>Nilai rata-rata ASC</option>
                                    <option value="grade_avg_desc" @if(request()->get('sort') == 'grade_avg_desc') selected @endif>Nilai rata-rata DESC</option>
                                    <option value="created_at_asc" @if(request()->get('sort') == 'created_at_asc') selected @endif>Tanggal dibuat ASC</option>
                                    <option value="created_at_desc" @if(request()->get('sort') == 'created_at_desc') selected @endif>Tanggal dibuat DESC</option>
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
                                <label class="input-label">Pelatihan</label>
                                <select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2"
                                        data-placeholder="Search classes">

                                    @if(!empty($webinars) and $webinars->count() > 0)
                                        @foreach($webinars as $webinar)
                                            <option value="{{ $webinar->id }}" selected>{{ $webinar->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Status</label>
                                <select name="statue" data-plugin-selectTwo class="form-control populate">
                                    <option value="">Semua status</option>
                                    <option value="active" @if(request()->get('status') == 'active') selected @endif>Aktif</option>
                                    <option value="inactive" @if(request()->get('status') == 'inactive') selected @endif>Tidak aktif</option>
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
                        <div class="card-header">
                            @can('admin_quizzes_lists_excel')
                                <div class="text-right">
                                    <a href="/admin/quizzes/excel?{{ http_build_query(request()->all()) }}" class="btn btn-primary">Export excel</a>
                                </div>
                            @endcan

                            @can('admin_quizzes_create')
                                <div class="text-right">
                                    <a href="/admin/quizzes/create" class="btn btn-primary ml-2">Kuis baru</a>
                                </div>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th class="text-left">Judul</th>
                                        <th class="text-left">Instruktur</th>
                                        <th class="text-center">Pertanyaan</th>
                                        <th class="text-center">Peserta</th>
                                        <th class="text-center">Nilai rata-rata</th>
                                        <th class="text-center">Sertifikat</th>
                                        <th class="text-center">Status</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @foreach($quizzes as $quiz)
                                        <tr>
                                            <td>
                                                <span>{{ $quiz->title }}</span>
                                                @if(!empty($quiz->webinar))
                                                    <small class="d-block text-left text-primary">{{ $quiz->webinar->title }}</small>
                                                @endif
                                            </td>

                                            <td class="text-left">{{ $quiz->teacher->full_name }}</td>

                                            <td class="text-center">
                                                {{ $quiz->quizQuestions->count() }}
                                            </td>

                                            <td class="text-center">
                                                <span>{{ $quiz->quizResults->pluck('user_id')->count() }}</span>
                                                <span class="d-block text-primary font-12">(Lulus: {{ $quiz->quizResults->where('status','passed')->count() }})</span>
                                            </td>

                                            <td class="text-center">{{ round($quiz->quizResults->avg('user_grade'),2) }} </td>

                                            <td class="text-center">
                                                @if($quiz->certificate)
                                                    <a class="text-success fas fa-check"></a>
                                                @else
                                                    <a class="text-danger fas fa-times"></a>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if($quiz->status === \App\Models\Quiz::ACTIVE)
                                                    <span class="text-success">Aktif</span>
                                                @else
                                                    <span class="text-warning">Tidak aktif</span>
                                                @endif
                                            </td>

                                            <td>
                                                @can('admin_quizzes_results')
                                                    <a href="/admin/quizzes/{{ $quiz->id }}/results" class="btn-transparent btn-sm text-primary" data-toggle="tooltip" title="Hasil">
                                                        <i class="fa fa-poll fa-1x"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_quizzes_edit')
                                                    <a href="/admin/quizzes/{{ $quiz->id }}/edit" class="btn-transparent btn-sm text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_quizzes_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/quizzes/'.$quiz->id.'/delete' , 'btnClass' => 'btn-sm'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $quizzes->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>a
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
