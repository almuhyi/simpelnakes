@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Penjualan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Penjualan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total penjualan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSales['count'] }}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-play-circle"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pelatihan</h4>
                            </div>
                            <div class="card-body">
                                {{ $classesSales['count'] }}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-calendar-alt"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pertemuan</h4>
                            </div>
                            <div class="card-body">
                                {{ $appointmentSales['count'] }}
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
                                {{ $failedSales }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" class="form-control" name="item_title" value="{{ request()->get('item_title') }}">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal akhir</label>
                                    <div class="input-group">
                                        <input type="date" id="lsdate" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                    </div>
                                </div>
                            </div>





                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Pelatihan</label>
                                    <select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2"
                                            data-placeholder="Search classes">

                                        @if(!empty($webinars) and $webinars->count() > 0)
                                            @foreach($webinars as $webinar)
                                                <option value="{{ $webinar->id }}" selected>{{ $webinar->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Instruktur</label>
                                    <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role" class="form-control search-user-select2"
                                            data-placeholder="Search teachers">

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
                                    <label class="input-label">Peserta</label>
                                    <select name="student_ids[]" multiple="multiple" data-search-option="just_student_role" class="form-control search-user-select2"
                                            data-placeholder="Search students">

                                        @if(!empty($students) and $students->count() > 0)
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}" selected>{{ $student->full_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="Lihat hasil">
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
                            @can('admin_sales_export')
                                <a href="{{ url('/admin/financial/sales/export') }}" class="btn btn-primary">Export excel</a>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Peserta</th>
                                        <th class="text-left">Instruktur</th>
                                        <th>Jumlah</th>
                                        <th>Diskon</th>
                                        <th>Pajak</th>
                                        <th class="text-left">Item</th>
                                        <th>Jenis Penjualan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                    @foreach($sales as $sale)
                                        <tr>
                                            <td>{{ $sale->id }}</td>

                                            <td class="text-left">
                                                {{ !empty($sale->buyer) ? $sale->buyer->full_name : '' }}
                                                <div class="text-primary text-small font-600-bold">ID : {{  !empty($sale->buyer) ? $sale->buyer->id : '' }}</div>
                                            </td>

                                            <td class="text-left">
                                                {{ $sale->item_seller }}
                                                <div class="text-primary text-small font-600-bold">ID : {{  $sale->seller_id }}</div>
                                            </td>

                                            <td>
                                                @if($sale->payment_method == \App\Models\Sale::$subscribe)
                                                    <span class="">Berlangganan</span>
                                                @else
                                                    @if(!empty($sale->total_amount))
                                                        <span class="">{{ addCurrencyToPrice(handlePriceFormat($sale->total_amount)) }}</span>
                                                    @else
                                                        <span class="">Gratis</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <span class="">{{ addCurrencyToPrice(handlePriceFormat($sale->discount)) }}</span>
                                            </td>
                                            <td>
                                                <span class="">{{ addCurrencyToPrice(handlePriceFormat($sale->tax)) }}</span>
                                            </td>
                                            <td class="text-left">
                                                <div class="media-body">
                                                    <div>{{ $sale->item_title }}</div>
                                                    <div class="text-primary text-small font-600-bold">ID : {{ $sale->item_id }}</div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="font-weight-bold">
                                                    @if($sale->type == \App\Models\Sale::$registrationPackage)
                                                        Paket SaaS
                                                    @elseif($sale->type == \App\Models\Sale::$product)
                                                        Produk
                                                    @elseif($sale->type == \App\Models\Sale::$bundle)
                                                        Bundel
                                                    @else
                                                        {{ $sale->type }}
                                                    @endif
                                                </span>
                                            </td>

                                            <td>{{ dateTimeFormat($sale->created_at, 'j F Y H:i') }}</td>

                                            <td>
                                                @if(!empty($sale->refund_at))
                                                    <span class="text-warning">Pengembalian dana</span>
                                                @elseif(!$sale->access_to_purchased_item)
                                                    <span class="text-danger">Akses diblokir</span>
                                                @else
                                                    <span class="text-success">Sukses</span>
                                                @endif
                                            </td>

                                            <td>
                                                @can('admin_sales_invoice')
                                                    @if(!empty($sale->webinar_id))
                                                        <a href="{{ url('') }}/admin/financial/sales/{{ $sale->id }}/invoice" target="_blank" title="Faktur"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                    @endif
                                                @endcan

                                                @can('admin_sales_refund')
                                                    @if(empty($sale->refund_at) and $sale->payment_method != \App\Models\Sale::$subscribe)
                                                        @include('admin.includes.delete_button',[
                                                                'url' => '/admin/financial/sales/'. $sale->id .'/refund',
                                                                'tooltip' => 'pengembalian dana',
                                                                'btnIcon' => 'fa-times-circle'
                                                            ])
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $sales->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

