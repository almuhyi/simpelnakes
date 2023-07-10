@extends('admin.layouts.app')

@push('styles_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar konsultan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Konsultan</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total konsultan</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalConsultants }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Konsultan Tersedia</h4>
                        </div>
                        <div class="card-body">
                            {{ $availableConsultants }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-times"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Konsultan tidak Tersedia</h4>
                        </div>
                        <div class="card-body">
                            {{ $unavailableConsultants }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users-slash"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Konsultan Tanpa pertemuan</h4>
                        </div>
                        <div class="card-body">
                            {{ $consultantsWithoutAppointment }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form class="mb-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" class="form-control" name="search" value="{{ request()->get('search') }}">
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


                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.filters')}}</label>
                                    <select name="sort" data-plugin-selectTwo class="form-control populate">
                                        <option value="">{{trans('admin/main.filter_type')}}</option>
                                        <option value="appointments_asc" @if(request()->get('sort') == 'appointments_asc') selected @endif>{{trans('admin/main.sales_appointments_ascending')}}</option>
                                        <option value="appointments_desc" @if(request()->get('sort') == 'appointments_desc') selected @endif>{{trans('admin/main.sales_appointments_descending')}}</option>
                                        <option value="appointments_income_asc" @if(request()->get('sort') == 'appointments_income_asc') selected @endif>{{trans('admin/main.appointments_income_ascending')}}</option>
                                        <option value="appointments_income_desc" @if(request()->get('sort') == 'appointments_income_desc') selected @endif>{{trans('admin/main.appointments_income_descending')}}</option>
                                        <option value="pending_appointments_asc" @if(request()->get('sort') == 'pending_appointments_asc') selected @endif>{{trans('admin/main.pending_appointments_ascending')}}</option>
                                        <option value="pending_appointments_desc" @if(request()->get('sort') == 'pending_appointments_desc') selected @endif>{{trans('admin/main.pending_appointments_descending')}}</option>
                                        <option value="created_at_asc" @if(request()->get('sort') == 'created_at_asc') selected @endif>{{trans('admin/main.register_date_ascending')}}</option>
                                        <option value="created_at_desc" @if(request()->get('sort') == 'created_at_desc') selected @endif>{{trans('admin/main.register_date_descending')}}</option>
                                    </select>
                                </div>
                            </div> --}}


                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.organization')}}</label>
                                    <select name="organization_id" data-plugin-selectTwo class="form-control populate">
                                        <option value="">{{trans('admin/main.select_organization')}}</option>
                                        @foreach($organizations as $organization)
                                            <option value="{{ $organization->id }}" @if(request()->get('organization_id') == $organization->id) selected @endif>{{ $organization->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Grup pengguna</label>
                                    <select name="group_id" class="form-control populate">
                                        <option value="">Pilih grup pengguna</option>
                                        @foreach($userGroups as $userGroup)
                                            <option value="{{ $userGroup->id }}" @if(request()->get('group_id') == $userGroup->id) selected @endif>{{ $userGroup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="disabled" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua status</option>
                                        <option value="0" @if(request()->get('disabled') == '0') selected @endif>Tersedia</option>
                                        <option value="1" @if(request()->get('disabled') == '1') selected @endif>Tidak tersedia</option>
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

            <div class="card">
                <div class="card-header">
                    @can('admin_consultants_export_excel')
                        <a href="{{ url('') }}/admin/consultants/excel?{{ http_build_query(request()->all()) }}" class="btn btn-primary">Export excel</a>
                    @endcan

                    <div class="h-10"></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-center">
                        <table class="table table-striped font-14">
                            <tr>
                                <th>ID</th>
                                <th class="text-left">Nama</th>
                                <th>Pertemuan</th>
                                <th>Pertemuan tertunda</th>
                                {{-- <th>{{trans('admin/main.wallet_charge')}}</th> --}}
                                <th>Grup pengguna</th>
                                <th>
                                    tanggal Registrasi</th>
                                <th>Status</th>
                                <th width="120">Aksi</th>

                            </tr>

                            @foreach($consultants as $consultant)
                                <tr>
                                    <td>{{ $consultant->id }}</td>

                                    <td class="text-left">
                                     <div class="d-flex align-items-center">
                                        <figure class="avatar mr-2">
                                            <img src="{{ $consultant->getAvatar() }}" alt="...">
                                        </figure>
                                        <div class="media-body ml-1">
                                            <div class="mt-0 mb-1 font-weight-bold">{{ $consultant->full_name }}</div>
                                            <div class="text-primary text-small font-600-bold">{{ $consultant->mobile }}</div>
                                        </div>
                                       </div>
                                    </td>

                                    <td>
                                        <div class="media-body">
                                            <div class="text-primary mt-0 mb-1 font-weight-bold">{{ $consultant->sales_count }}</div>

                                            {{-- @if($consultant->sales_amount > 0)
                                                <div class="text-small font-600-bold">{{ addCurrencyToPrice($consultant->sales_amount) }}</div>
                                            @endif --}}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        {{ $consultant->pendingAppointments }}
                                    </td>

                                    {{-- <td>
                                        @if($consultant->totalIncome > 0)
                                            {{ addCurrencyToPrice($consultant->getAccountingBalance()) }}
                                        @else
                                            0
                                        @endif
                                    </td> --}}

                                    <td>{{ !empty($consultant->userGroup) ? $consultant->userGroup->group->name : '-' }}</td>

                                    <td>{{ dateTimeFormat($consultant->created_at, 'j M Y | H:i') }}</td>

                                    <td>
                                        @if($consultant->disabled)
                                            <div class="text-danger mt-0 mb-1 font-weight-bold">Tidak tersedian</div>
                                        @else
                                            <div class="text-success mt-0 mb-1 font-weight-bold">Tersedia</div>
                                        @endif
                                    </td>

                                    <td class="text-center mb-2" width="120">
                                        @can('admin_users_impersonate')
                                            <a href="{{ url('') }}/admin/users/{{ $consultant->id }}/impersonate" target="_blank" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Masuk">
                                                <i class="fa fa-user-shield"></i>
                                            </a>
                                        @endcan

                                        @can('admin_users_edit')
                                            <a href="{{ url('') }}/admin/users/{{ $consultant->id }}/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('admin_users_delete')
                                            @include('admin.includes.delete_button',['url' => '/admin/users/'.$consultant->id.'/delete' , 'btnClass' => ''])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $consultants->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>

            <section class="card">
                <div class="card-body">
           <div class="section-title ml-0 mt-0 mb-3"> <h4>Petunjuk</h4> </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="media-body">
                                <div class="text-primary mt-0 mb-1 font-weight-bold">Menjadi Konsultan</div>
                                <div class=" text-small font-600-bold">Instruktur yang menentukan lembar waktu pertemuan mereka akan ditampilkan dalam daftar ini. Instruktur dapat menentukan lembar waktu pertemuan dari panel mereka.</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="media-body">
                                <div class="text-primary mt-0 mb-1 font-weight-bold">
                                    Pertemuan Tertunda</div>
                                <div class=" text-small font-600-bold">Pertemuan yang dipesan oleh peserta tetapi belum dilakukan. Tertunda, mungkin sedang berlangsung atau belum dimulai.</div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="media-body">
                                <div class="text-primary mt-0 mb-1 font-weight-bold">Konsultan Tidak Tersedia</div>
                                <div class="text-small font-600-bold">Instruktur mungkin tidak tersedia untuk sementara. Mereka dapat mengubah status dari pengaturan pertemuan di panel pengguna.</div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </section>

@endsection
