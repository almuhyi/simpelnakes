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

        <div class="section-body">
            @php
                $unreadNotificationsIds = [];
                if(!empty($unreadNotifications) and count($unreadNotifications)) {
                    $unreadNotificationsIds=$unreadNotifications->pluck('id')->toArray();
                }
            @endphp

            <div class="card">
                <div class="card-header">
                    @can('admin_notifications_send')
                        <div class="text-right">
                            <a href="{{ url('/admin/notifications/send') }}" class="btn btn-primary">Kirim notifikasi</a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped font-14" id="datatable-basic">

                            <tr>
                                <th class="text-left">Judul</th>
                                <th class="text-center">Pengirim</th>
                                <th class="text-center">Pesan</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>

                            @foreach($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->title }}</td>
                                    <td class="text-center">{{ $notification->sender }}</td>
                                    <td class="text-center">
                                        <button type="button" data-item-id="{{ $notification->id }}" class="js-show-description btn btn-outline-primary">Lihat</button>
                                        <input type="hidden" value="{{ nl2br($notification->message) }}">
                                    </td>
                                    <td class="text-center">{{ $notification->type }}</td>
                                    <td class="text-center">
                                        @if(in_array($notification->id,$unreadNotificationsIds))
                                            <span class="text-danger">
                                                Belum dibaca</span>
                                        @else
                                            <span class="text-success">Dibaca</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ dateTimeFormat($notification->created_at,'j M Y | H:i') }}</td>

                                    <td width="100">

                                        @can('admin_notifications_delete')
                                            @include('admin.includes.delete_button',['url' => '/admin/notifications/'. $notification->id.'/delete','btnClass' => ''])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $notifications->appends(request()->input())->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="notificationMessageModal" tabindex="-1" aria-labelledby="notificationMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationMessageLabel">Pesan Kontak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/js/admin/notifications.min.js"></script>
@endpush
