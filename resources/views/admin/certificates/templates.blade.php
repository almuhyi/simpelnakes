@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Template sertifikat</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Template sertifikat</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th class="text-left">Judul</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @foreach($templates as $template)
                                        <tr>
                                            <td>
                                                <span>{{ $template->title }}</span>
                                            </td>

                                            <td>
                                                @if($template->type == 'quiz')
                                                    <span class="">Sertifikat kuis</span>
                                                @else
                                                    <span class="">Sertifikat penyelesaian pelatihan</span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="text-{{ ($template->status == 'publish') ? 'success' : '' }}">{{ $template->status }}</span>
                                            </td>

                                            <td>
                                                @can('admin_certificate_template_edit')
                                                    <a href="/admin/certificates/templates/{{ $template->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_certificate_template_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/certificates/templates/'. $template->id .'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $templates->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

