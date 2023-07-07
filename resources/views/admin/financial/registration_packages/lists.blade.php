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
                        <i class="fas fa-users-cog	"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalPackages }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-tie"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>
                                Paket Instruktur Aktif</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalActiveByInstructors }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-briefcase"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Paket Organisasi Aktif</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalActiveByOrganization }}
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
                                        <th>#</th>
                                        <th class="text-left">Judul</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Hari</th>
                                        <th class="text-center">Jumlah Penjualan pelatihan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Tanggal dibuat</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @foreach($packages as $package)
                                        <tr>
                                            <td>
                                                <img src="{{ $package->icon }}" width="50" height="50" alt="">
                                            </td>
                                            <td class="text-left">{{ $package->title }}</td>
                                            <td class="text-center">{{ $package->role }}</td>
                                            <td class="text-center">{{ addCurrencyToPrice($package->price) }}</td>
                                            <td class="text-center">{{ $package->days }}</td>
                                            <td class="text-center">{{ $package->sales->count() }}</td>
                                            <td class="text-center">
                                                <span class="{{ $package->status == 'active' ? 'text-success' : 'text-danger' }}">{{ $package->status }}</span>
                                            </td>
                                            <td class="text-center">{{ dateTimeFormat($package->created_at, 'Y M j | H:i') }}</td>
                                            <td>
                                                @can('admin_registration_packages_edit')
                                                    <a href="/admin/financial/registration-packages/{{ $package->id }}/edit" class="btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_registration_packages_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/financial/registration-packages/'. $package->id.'/delete','btnClass' => 'btn-sm'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $packages->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="card">
        <div class="card-body">
            <div class="section-title ml-0 mt-0 mb-3"><h5>Petunjuk</h5></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Statistik Paket</div>
                        <div class=" text-small font-600-bold">Anda dapat melihat jumlah paket yang diaktifkan berdasarkan peran pengguna yang berbeda.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">
                        Parameter Bawaan</div>
                        <div class=" text-small font-600-bold">Jangan batasi pengguna untuk paket. Tetapkan nilai default dari SaaS/Pengaturan dan biarkan mereka mencoba platofrm Anda.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

