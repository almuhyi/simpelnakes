@extends('admin.layouts.app')


@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Pelatihan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Pelatihan</div>

                <div class="breadcrumb-item">{{ $classesType }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-file-video"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pelatihan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalWebinars }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-eye"></i>
                        </div>

                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>belum ditinjau</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPendingWebinars }}
                            </div>
                        </div>
                    </div>
                </div>

                @if($classesType == 'webinar')
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-history"></i>
                            </div>

                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Kelas sedang berlangsung</h4>
                                </div>
                                <div class="card-body">
                                    {{ $inProgressWebinars }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-history"></i>
                            </div>

                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Durasi</h4>
                                </div>
                                <div class="card-body">
                                    {{ convertMinutesToHourAndMinute($totalDurations) }} Jam
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-dollar-sign"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{trans('admin/main.total_sales')}}</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSales }}
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <input type="hidden" name="type" value="{{ request()->get('type') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input name="title" type="text" class="form-control" value="{{ request()->get('title') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal Mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="from" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal Berakhir</label>
                                    <div class="input-group">
                                        <input type="date" id="to" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Filter</label>
                                    <select name="sort" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Filter</option>
                                        <option value="has_discount" @if(request()->get('sort') == 'has_discount') selected @endif>Kelas Diskon</option>
                                        <option value="sales_asc" @if(request()->get('sort') == 'sales_asc') selected @endif>Penjualan ASC</option>
                                        <option value="sales_desc" @if(request()->get('sort') == 'sales_desc') selected @endif>Penjualan DESC</option>
                                        <option value="price_asc" @if(request()->get('sort') == 'price_asc') selected @endif>Harga ASC</option>
                                        <option value="price_desc" @if(request()->get('sort') == 'price_desc') selected @endif>Harga DESC</option>
                                        <option value="income_asc" @if(request()->get('sort') == 'income_asc') selected @endif>Penghasilan ASC</option>
                                        <option value="income_desc" @if(request()->get('sort') == 'income_desc') selected @endif>Penghasilan DESC</option>
                                        <option value="created_at_asc" @if(request()->get('sort') == 'created_at_asc') selected @endif>Tanggal ASC</option>
                                        <option value="created_at_desc" @if(request()->get('sort') == 'created_at_desc') selected @endif>Tanggal DESC</option>
                                        <option value="updated_at_asc" @if(request()->get('sort') == 'updated_at_asc') selected @endif>Update ASC</option>
                                        <option value="updated_at_desc" @if(request()->get('sort') == 'updated_at_desc') selected @endif>Update DESC</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Instruktur</label>
                                    <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role" class="form-control search-user-select2"
                                            data-placeholder="Cari Instruktur">

                                        @if(!empty($teachers) and $teachers->count() > 0)
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" selected>{{ $teacher->full_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Kategori</label>
                                    <select name="category_id" data-plugin-selectTwo class="form-control populate">
                                        <option value="">All Kategori</option>

                                        @foreach($categories as $category)
                                            @if(!empty($category->subCategories) and count($category->subCategories))
                                                <optgroup label="{{  $category->title }}">
                                                    @foreach($category->subCategories as $subCategory)
                                                        <option value="{{ $subCategory->id }}" @if(request()->get('category_id') == $subCategory->id) selected="selected" @endif>{{ $subCategory->title }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option value="{{ $category->id }}" @if(request()->get('category_id') == $category->id) selected="selected" @endif>{{ $category->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">All Status</option>
                                        <option value="pending" @if(request()->get('status') == 'pending') selected @endif>Tinjauan tertunda</option>
                                        @if($classesType == 'webinar')
                                            <option value="active_not_conducted" @if(request()->get('status') == 'active_not_conducted') selected @endif>Publish tidak dilakukan</option>
                                            <option value="active_in_progress" @if(request()->get('status') == 'active_in_progress') selected @endif>Publish sedang berlangsung</option>
                                            <option value="active_finished" @if(request()->get('status') == 'active_finished') selected @endif>Publish Selesai</option>
                                        @else
                                            <option value="active" @if(request()->get('status') == 'active') selected @endif>Published</option>
                                        @endif
                                        <option value="inactive" @if(request()->get('status') == 'inactive') selected @endif>Ditolak</option>
                                        <option value="is_draft" @if(request()->get('status') == 'is_draft') selected @endif>Draft</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="Lihat">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @can('admin_webinars_export_excel')
                                <div class="text-right">
                                    <a href="{{ url('') }}/admin/webinars/excel?{{ http_build_query(request()->all()) }}" class="btn btn-primary">Export</a>
                                </div>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Id</th>
                                        <th class="text-left">Judul</th>
                                        <th class="text-left">Instruktur</th>
                                        <th>Harga</th>
                                        <th>Penjualan</th>
                                        <th>Penghasilan</th>
                                        <th>Peserta</th>
                                        <th>Dibuat</th>
                                        @if($classesType == 'webinar')
                                            <th>Tanggal pelaksanaan</th>
                                        @else
                                            <th>Diupdate</th>
                                        @endif
                                        <th>Status</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                    @foreach($webinars as $webinar)
                                        <tr class="text-center">
                                            <td>{{ $webinar->id }}</td>
                                            <td width="18%" class="text-left">
                                                <a class="text-primary mt-0 mb-1 font-weight-bold" href="{{ url($webinar->getUrl()) }}">{{ $webinar->title }}</a>
                                                @if(!empty($webinar->category->title))
                                                    <div class="text-small">{{ $webinar->category->title }}</div>
                                                @else
                                                    <div class="text-small text-warning">Tidak ada kategori</div>
                                                @endif
                                            </td>

                                            <td class="text-left">{{ $webinar->teacher->full_name }}</td>

                                            <td>
                                                @if(!empty($webinar->price) and $webinar->price > 0)
                                                    <span class="mt-0 mb-1">
                                                        {{ handlePrice($webinar->price, true, true) }}
                                                    </span>

                                                    @if($webinar->getDiscountPercent() > 0)
                                                        <div class="text-danger text-small font-600-bold">{{ $webinar->getDiscountPercent() }}% Off</div>
                                                    @endif
                                                @else
                                                    Gratis
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-primary mt-0 mb-1 font-weight-bold">
                                                    {{ $webinar->sales->count() }}
                                                </span>

                                                @if($classesType == 'webinar')
                                                    <div class="text-small font-600-bold">Kapasitas : {{ $webinar->getWebinarCapacity() }}</div>
                                                @endif
                                            </td>

                                            <td>{{ addCurrencyToPrice($webinar->sales->sum('total_amount')) }}</td>

                                            <td class="font-12">
                                                <a href="{{ url('') }}/admin/webinars/{{ $webinar->id }}/students" target="_blank" class="">{{ $webinar->sales->count() }}</a>
                                            </td>

                                            <td class="font-12">{{ dateTimeFormat($webinar->created_at, 'j M Y | H:i') }}</td>

                                            @if($classesType == 'webinar')
                                                <td class="font-12">{{ dateTimeFormat($webinar->start_date, 'j M Y | H:i') }}</td>
                                            @else
                                                <td class="font-12">{{ dateTimeFormat($webinar->updated_at, 'j M Y | H:i') }}</td>
                                            @endif

                                            <td>
                                                @switch($webinar->status)
                                                    @case(\App\Models\Webinar::$active)
                                                    <div class="text-success font-600-bold">Publish</div>
                                                    @if($webinar->isWebinar())
                                                        @if($webinar->isProgressing())
                                                            <div class="text-warning text-small">(Sedang proses)</div>
                                                        @elseif($webinar->start_date > time())
                                                            <div class="text-danger text-small">(Tidak diadakan)</div>
                                                        @else
                                                            <div class="text-success text-small">(Selesai)</div>
                                                        @endif
                                                    @endif
                                                    @break
                                                    @case(\App\Models\Webinar::$isDraft)
                                                    <span class="text-dark">Draft</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$pending)
                                                    <span class="text-warning">Menunggu</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$inactive)
                                                    <span class="text-danger">Ditolak</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td width="200" class="">
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu text-left webinars-lists-dropdown">
                                                        @can('admin_webinar_notification_to_students')
                                                            <a href="{{ url('') }}/admin/webinars/{{ $webinar->id }}/sendNotification" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                                <i class="fa fa-bell"></i>
                                                                <span class="ml-2">Kirim Pemberitahuan</span>
                                                            </a>
                                                        @endcan

                                                        @can('admin_webinar_students_lists')
                                                            <a href="{{ url('') }}/admin/webinars/{{ $webinar->id }}/students" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 " title="peserta">
                                                                <i class="fa fa-users"></i>
                                                                <span class="ml-2">Peserta</span>
                                                            </a>
                                                        @endcan

                                                        @can('admin_webinar_statistics')
                                                            <a href="{{ url('') }}/admin/webinars/{{ $webinar->id }}/statistics" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 " title="peserta">
                                                                <i class="fa fa-chart-pie"></i>
                                                                <span class="ml-2">Statistik</span>
                                                            </a>
                                                        @endcan

                                                        @can('admin_support_send')
                                                            <a href="{{ url('') }}/admin/supports/create?user_id={{ $webinar->teacher->id }}" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1" title="kirim pesan ke instruktur">
                                                                <i class="fa fa-comment"></i>
                                                                <span class="ml-2">Kirim Pesan</span>
                                                            </a>
                                                        @endcan

                                                        @can('admin_webinars_edit')
                                                            <a href="{{ url('') }}/admin/webinars/{{ $webinar->id }}/edit" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 " title="edit">
                                                                <i class="fa fa-edit"></i>
                                                                <span class="ml-2">Edit</span>
                                                            </a>
                                                        @endcan

                                                        @can('admin_webinars_delete')
                                                            @include('admin.includes.delete_button',[
                                                                    'url' => '/admin/webinars/'.$webinar->id.'/delete',
                                                                    'btnClass' => 'd-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm mt-1',
                                                                    'btnText' => '<i class="fa fa-times"></i><span class="ml-2">'. "Hapus" .'</span>'
                                                                    ])
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $webinars->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
