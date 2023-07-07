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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped font-14" id="datatable-basic">

                            <tr>
                                <th class="text-left">Username</th>
                                <th class="text-left">Email</th>
                                <th class="text-center">No HP</th>
                                <th class="text-left">Subjek</th>
                                <th class="text-center">Pesan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">
                                    Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>

                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td class="text-left">{{ $contact->email }}</td>
                                    <td class="text-center">{{ $contact->phone }}</td>
                                    <td class="text-left">{{ $contact->subject }}</td>

                                    <td class="text-center">
                                        <button type="button" class="js-show-description btn btn-outline-primary">Lihat</button>
                                        <input type="hidden" value="{!! nl2br($contact->message) !!}">
                                    </td>

                                    <td class="text-center">
                                        @if($contact->status =='replied')
                                            <span class="text-success">Dibalas</span>
                                        @else
                                            <span class="text-danger">Belum dibalas</span>
                                        @endif
                                    </td>

                                    <td class="text-center">{{ dateTimeFormat($contact->created_at,'Y M j | H:i') }}</td>

                                    <td width="100">
                                        @can('admin_contacts_reply')
                                            <a href="/admin/contacts/{{ $contact->id }}/reply" class="btn-transparent btn-sm text-primary" data-toggle="tooltip" data-placement="top" title="Balas">
                                                <i class="fa fa-reply"></i>
                                            </a>
                                        @endcan

                                        @can('admin_contacts_delete')
                                            @include('admin.includes.delete_button',['url' => '/admin/contacts/'. $contact->id.'/delete','btnClass' => 'btn-sm'])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $contacts->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="contactMessage" tabindex="-1" aria-labelledby="contactMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactMessageLabel">Pesan kontak</h5>
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
    <script src="/assets/default/js/admin/contacts.min.js"></script>
@endpush
