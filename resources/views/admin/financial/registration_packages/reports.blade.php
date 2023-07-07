@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Paket SaaS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Paket SaaS</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Penjualan Paket Instruktur</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalBuyInstructorsPackages }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-clipboard-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Penjualan Paket Organisasi</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalBuyOrganizationPackages }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah total</h4>
                        </div>
                        <div class="card-body">
                            {{ addCurrencyToPrice($sales->sum('total_amount')) }}
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total penjualan</h4>
                        </div>
                        <div class="card-body">
                            {{ $sales->count() }}
                        </div>
                    </div>
                </div>
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
                                        <th class="text-left">Pengguna</th>
                                        <th class="text-center">Role pengguna</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Hari</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Tanggal Aktivasi</th>
                                        <th class="text-center">Tanggal kadaluarsa</th>
                                    </tr>

                                    @foreach($sales as $sale)
                                        <tr>
                                            <td class="text-left">{{ !empty($sale->buyer) ? $sale->buyer->full_name : '' }}</td>
                                            <td class="text-center">{{ !empty($sale->buyer) ? $sale->buyer->role_name : '' }}</td>
                                            <td class="text-center">{{ !empty($sale->registrationPackage) ? $sale->registrationPackage->title : '' }}</td>
                                            <td class="text-center">{{ !empty($sale->registrationPackage) ? $sale->registrationPackage->days : '' }}</td>
                                            <td class="text-center">{{ !empty($sale->registrationPackage) ? addCurrencyToPrice($sale->registrationPackage->price) : '' }}</td>
                                            <td class="text-center">{{ dateTimeFormat($sale->created_at, 'Y M j | H:i') }}</td>
                                            <td class="text-center">{{ !empty($sale->registrationPackage) ? dateTimeFormat(($sale->created_at + ($sale->registrationPackage->days * 24 * 60 *60)) , 'Y M j | H:i') : '' }}</td>
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

