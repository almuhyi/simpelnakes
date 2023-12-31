@extends('admin.layouts.app')

@push('libraries_top')

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

        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-comments"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total percakapan</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalConversations }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-comment-dots"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Percakapan dibuka</h4>
                        </div>
                        <div class="card-body">
                            {{ $openConversationsCount }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-comment-slash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Percakapan ditutup</h4>
                        </div>
                        <div class="card-body">
                            {{ $closeConversationsCount }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pelatihan dengan bantuan</h4>
                        </div>
                        <div class="card-body">
                            {{ $classesWithSupport }}
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form class="mb-0">
                        <input type="hidden" name="type" value="course_conversations">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" name="webinar_title" value="{{ request()->get('webinar_title') }}" class="form-control text-center">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="from" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal akhir</label>
                                    <div class="input-group">
                                        <input type="date" id="to" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua status</option>
                                        <option value="open" @if(request()->get('status') == 'open') selected @endif>Dibuka</option>
                                        <option value="close" @if(request()->get('status') == 'close') selected @endif>Ditutup</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Pelatihan</label>
                                    <select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2"
                                            data-placeholder="Cari pelatihan">

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
                                    <label class="input-label">Instruktur</label>
                                    <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role" class="form-control search-user-select2"
                                            data-placeholder="Cari instruktur">

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
                                            data-placeholder="Cari peserta">

                                        @if(!empty($students) and $students->count() > 0)
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}" selected>{{ $student->full_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="Lihat hasil">
                                </div>
                            </div>
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
                                        <th>Judul</th>
                                        <th class="text-left">Pelatihan</th>
                                        <th class="text-left">Instruktur</th>
                                        <th class="text-left">Peserta</th>
                                        <th class="text-center">Tanggal Dibuat</th>
                                        <th class="text-center">Pembaharuan Terakhir</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    @foreach($supports as $support)
                                        <tr>
                                            <td>{{ $support->title }}</td>

                                            <td class="text-left">
                                                <a href="{{ url($support->webinar->getUrl()) }}" target="_blank">{{ $support->webinar->title }}</a>
                                            </td>

                                            <td class="text-left">
                                                <a href="{{ url($support->webinar->teacher->getProfileUrl()) }}" target="_blank">{{ $support->webinar->teacher->full_name }}</a>
                                            </td>

                                            <td class="text-left">
                                                <a href="{{ url($support->user->getProfileUrl()) }}" target="_blank">{{ $support->user->full_name }}</a>
                                            </td>

                                            <td>{{ dateTimeFormat($support->created_at,'j M Y | H:i') }}</td>

                                            <td>{{ (!empty($support->updated_at)) ? dateTimeFormat($support->updated_at,'j M Y | H:i') : '-' }}</td>

                                            <td class="text-center">
                                                @if($support->status == 'close')
                                                    <span class="text-warning">Ditutup</span>
                                                @else
                                                    <span class="text-success">Dibuka</span>
                                                @endif
                                            </td>

                                            <td class="text-center" width="50">
                                                @can('admin_supports_reply')
                                                    <a href="{{ url('') }}/admin/supports/{{ $support->id }}/conversation" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Percakapan">
                                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_supports_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/supports/'.$support->id.'/delete' , 'btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $supports->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
