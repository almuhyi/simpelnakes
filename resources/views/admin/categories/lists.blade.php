@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kategori profesi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Kategori</div>
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
                                        <th class="text-left">Profesi</th>
                                        <th>Subkategori</th>
                                        <th>Pelatihan</th>
                                        <th>Instruktur</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach($categories as $category)

                                        <tr>
                                            <td>
                                                <img src="{{ $category->icon }}" width="30" alt="">
                                            </td>
                                            <td class="text-left">{{ $category->title }}</td>
                                            <td>{{ $category->subCategories->count() }}</td>
                                            <td>{{ count($category->getCategoryCourses()) }}</td>
                                            <td>{{ count($category->getCategoryInstructorsIdsHasMeeting()) }}</td>
                                            <td>
                                                @can('admin_categories_edit')
                                                    <a href="{{ url('') }}/admin/categories/{{ $category->id }}/edit"
                                                       class="btn-transparent btn-sm text-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('admin_categories_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/categories/'.$category->id.'/delete'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $categories->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
