@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="section-body">
            <section class="card">
                <div class="card-header">
                    @can('admin_agora_history_export')
                        <div class="text-right">
                            <a href="{{ url('/admin/agora_history/excel') }}" class="btn btn-primary">Export</a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center font-14">

                            <tr>
                                <th class="text-left">Pelatihan</th>
                                <th class="text-left">Sesi live</th>
                                <th class="text-center">Durasi waktu</th>
                                <th class="text-center">Tanggal mulai</th>
                                <th class="text-center">Tanggal akhir</th>
                                <th class="text-center">Durasi pertemuan</th>
                            </tr>

                            @foreach($agoraHistories as $agoraHistory)
                                @php
                                    $meetingDuration = ($agoraHistory->end_at - $agoraHistory->start_at) / 60;
                                @endphp

                                <tr>
                                    <td class="text-left">{{ $agoraHistory->session->webinar->title }}</td>
                                    <td class="text-left">{{ $agoraHistory->session->title }}</td>
                                    <td>{{ convertMinutesToHourAndMinute($agoraHistory->session->duration) }}</td>
                                    <td>{{ dateTimeFormat($agoraHistory->start_at, 'j M Y | H:i') }}</td>
                                    <td>{{ dateTimeFormat($agoraHistory->end_at, 'j M Y | H:i') }}</td>
                                    <td class="{{ ($meetingDuration > $agoraHistory->session->duration) ? 'text-danger' : 'text-success' }}">
                                        {{ convertMinutesToHourAndMinute($meetingDuration) }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $agoraHistories->links('vendor.pagination.bootstrap-4') }}
                </div>
            </section>
        </div>
    </section>
@endsection
