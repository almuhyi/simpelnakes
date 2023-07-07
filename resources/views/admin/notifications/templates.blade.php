@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Template</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Template</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped font-14" id="datatable-basic">

                        <tr>
                            <th>Judul</th>
                            <th>Aksi</th>
                        </tr>

                        @foreach($templates as $template)
                            <tr>
                                <td>{{ $template->title }}</td>

                                <td width="100">
                                    @can('admin_notifications_template_edit')
                                        <a href="/admin/notifications/templates/{{ $template->id }}/edit" class="btn-transparent btn-sm text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('admin_notifications_template_delete')
                                        @include('admin.includes.delete_button',['url' => '/admin/notifications/templates/'. $template->id.'/delete','btnClass' => 'btn-sm'])
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="card-footer text-center">
                    {{ $templates->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
@endsection

