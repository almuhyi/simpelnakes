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
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-pen"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tugas pelatihan</h4>
                        </div>
                        <div class="card-body">
                            {{ $courseAssignmentsCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-eye"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belum ditinjau</h4>
                        </div>
                        <div class="card-body">
                            {{ $pendingReviewCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Lulus</h4>
                        </div>
                        <div class="card-body">
                            {{ $passedCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-times"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Gagal</h4>
                        </div>
                        <div class="card-body">
                            {{ $failedCount }}
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
                                    <label class="input-label">Tanggal mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label">Tanggal akhir</label>
                                    <div class="input-group">
                                        <input type="date" id="lsdate" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" class="form-control populate">
                                        <option value="">Semua</option>
                                        <option value="active" {{ (request()->get('status') == 'active') ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ (request()->get('status') == 'inactive') ? 'selected' : '' }}>Tidak aktif</option>
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

            <section class="card">
                <div class="card-body">
                    <table class="table table-striped font-14" id="datatable-details">

                        <tr>
                            <th>Judul / pelatihan</th>
                            <th class="text-center">Peserta</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Nilai lulus</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>

                        @foreach($assignments as $assignment)
                            <tr>
                                <td class="text-left">
                                    <span class="d-block font-16 font-weight-500 text-dark-blue">{{ $assignment->title }}</span>
                                    <span class="d-block font-12 font-weight-500 text-gray">{{ $assignment->webinar->title }}</span>
                                </td>

                                <td class="align-middle">
                                    <span class="font-weight-500">{{ count($assignment->instructorAssignmentHistories) }}</span>
                                </td>

                                <td class="align-middle">
                                    <span>{{ $assignment->grade }}</span>
                                </td>

                                <td class="align-middle">
                                    <span>{{ $assignment->pass_grade }}</span>
                                </td>

                                <td class="align-middle">
                                    {{ $assignment->status }}
                                </td>

                                <td class="align-middle text-right">
                                    @can('admin_reviews_status_toggle')
                                        <a href="{{ url('') }}/admin/assignments/{{ $assignment->id }}/students" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Peserta">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </section>
        </div>
    </section>

@endsection

@push('scripts_bottom')

@endpush
