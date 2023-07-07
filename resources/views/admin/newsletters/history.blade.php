@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    @can('admin_newsletters_send')
                        <div class="text-right">
                            <a href="/admin/newsletters/send" class="btn btn-primary">Kirim buletin</a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped font-14" id="datatable-basic">

                            <tr>
                                <th class="text-left">Metode Pengiriman</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Email terkirim</th>
                                <th class="text-center">Tanggal dibuat</th>
                            </tr>

                            @foreach($newsletters as $newsletter)
                                <tr>
                                    <td>
                                        @switch($newsletter->send_method)
                                            @case('send_to_all')
                                            Kirim ke semua anggota buletin
                                            @break

                                            @case('send_to_bcc')
                                                Kirim ke email bbc
                                            @break

                                            @case('send_to_excel')
                                            Kirim ke daftar excel
                                            @break
                                        @endswitch
                                    </td>

                                    <td>{{ $newsletter->title }}</td>

                                    <td class="text-center">
                                        <button type="button" data-item-id="{{ $newsletter->id }}" class="js-show-description btn btn-outline-primary">Lihat</button>
                                        <input type="hidden" value="{{ nl2br($newsletter->description) }}">
                                    </td>

                                    <td class="text-center">{{ $newsletter->email_count }}</td>

                                    <td class="text-center">{{ dateTimeFormat($newsletter->created_at, 'j M Y | H:i') }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $newsletters->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="newsletterMessageModal" tabindex="-1" aria-labelledby="notificationMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationMessageLabel">Pesan</h5>
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
    <script src="/assets/default/js/admin/newsletter.min.js"></script>
@endpush
