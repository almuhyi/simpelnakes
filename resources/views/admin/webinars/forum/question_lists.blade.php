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
                <div class="breadcrumb-item">Pelatihan</div>

                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-question"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pertanyaan</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalQuestions }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Terselesaikan</h4>
                        </div>
                        <div class="card-body">
                            {{ $resolvedCount }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-hourglass"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belum terselesaikan</h4>
                        </div>
                        <div class="card-body">
                            {{ $notResolvedCount }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" name="title" value="{{ request()->get('title') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="date" value="{{ request()->get('date') }}" placeholder="Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Pengguna</label>

                                    <select name="user_id" class="form-control search-user-select2"
                                            data-placeholder="Cari pengguna">

                                        @if(!empty($user))
                                            <option value="{{ $user->id }}" selected>{{ $user->full_name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua status</option>
                                        <option value="resolved" @if(request()->get('status') == 'resolved') selected @endif>Terselesaikan</option>
                                        <option value="not_resolved" @if(request()->get('status') == 'not_resolved') selected @endif>Belum terselesaikan</option>
                                        <option value="pined" @if(request()->get('status') == 'pined') selected @endif>Disematkan</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2">
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
                                <table class="table table-striped font-14 ">
                                    <tr>
                                        <th class="text-left">Judul pertanyaan</th>
                                        <th class="">Tanggal Dibuat</th>
                                        <th class="">Tanggal Diperbarui</th>
                                        <th class="">Pembuat</th>
                                        <th>Jawaban</th>
                                        <th>Disematkan</th>
                                        <th>Terselesaikan</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                    @foreach($forums as $forum)
                                        <tr class="text-center">
                                            <td width="18%" class="text-left">
                                                <span class="font-weight-bold">{{ $forum->title }}</span>
                                            </td>

                                            <td class="">{{ dateTimeFormat($forum->created_at, 'j M Y | H:i') }}</td>

                                            <td class="">
                                                @if(!empty($forum->last_answer))
                                                    {{ dateTimeFormat($forum->last_answer->created_at, 'j M Y | H:i') }}
                                                @else
                                                    --
                                                @endif
                                            </td>

                                            <td class="">{{ $forum->user->full_name }}</td>

                                            <td class="">{{ $forum->answers_count }}</td>

                                            <td class="">
                                                @if($forum->pin)
                                                    Ya
                                                @else
                                                    Tidak
                                                @endif
                                            </td>

                                            <td class="">
                                                @if(!empty($forum->resolved))
                                                    Ya
                                                @else
                                                   Tidak
                                                @endif
                                            </td>


                                            <td width="200" class="btn-sm">
                                                @can('admin_course_question_forum_answers')
                                                    <a href="{{ url('') }}/admin/webinars/{{ $forum->webinar_id }}/forums/{{ $forum->id }}/answers" target="_blank" class="btn-transparent btn-sm text-primary mt-1 mr-1" data-toggle="tooltip" data-placement="top" title="Jawaban">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $forums->appends(request()->input())->links('vendor.pagination.bootstrap-4')  }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
