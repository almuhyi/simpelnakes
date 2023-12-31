@extends('admin.layouts.app')

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

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Icon</th>
                                        <th>Topik</th>
                                        <th class="text-center">Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @foreach($featuredTopics as $feature)

                                        <tr>
                                            <td>
                                                <img src="{{ asset($feature->icon) }}" alt="" width="48" height="48" class="">
                                            </td>

                                            <td class="text-center">{{ $feature->topic->title }}</td>

                                            <td class="text-center">{{ dateTimeFormat($feature->created_at, 'j M Y | H:i') }}</td>

                                            <td width="150">

                                                @can('admin_featured_topics_edit')
                                                    <a href="{{ url('') }}/admin/featured-topics/{{ $feature->id }}/edit" class="btn-sm" data-toggle="tooltip" data-placement="top" title="Edit}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_featured_topics_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/featured-topics/'. $feature->id .'/delete','btnClass' => 'btn-sm','icon' => true])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $featuredTopics->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
