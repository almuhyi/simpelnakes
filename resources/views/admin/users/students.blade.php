@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar peserta</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a>Peserta</a></div>
            </div>
        </div>
    </section>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total peserta</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalStudents }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-briefcase"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ trans('admin/main.organizations_students') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalOrganizationsStudents }}
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-info-circle"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Peserta Tidak Aktif</h4>
                        </div>
                        <div class="card-body">
                            {{ $inactiveStudents }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-ban"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Peserta dibanned</h4>
                        </div>
                        <div class="card-body">
                            {{ $banStudents }}
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
                                <input name="full_name" type="text" class="form-control" value="{{ request()->get('full_name') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Tanggal registrasi</label>
                                <div class="input-group">
                                    <input type="date" id="from" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Tanggal akhir</label>
                                <div class="input-group">
                                    <input type="date" id="to" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                </div>
                            </div>
                        </div> --}}


                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{ trans('admin/main.filters') }}</label>
                                <select name="sort" data-plugin-selectTwo class="form-control populate">
                                    <option value="">{{ trans('admin/main.filter_type') }}</option>
                                    <option value="purchased_classes_asc" @if(request()->get('sort') == 'purchased_classes_asc') selected @endif>{{ trans('admin/main.purchased_classes_ascending') }}</option>
                                    <option value="purchased_classes_desc" @if(request()->get('sort') == 'purchased_classes_desc') selected @endif>{{ trans('admin/main.purchased_classes_descending') }}</option>

                                    <option value="purchased_classes_amount_asc" @if(request()->get('sort') == 'purchased_classes_amount_asc') selected @endif>{{ trans('admin/main.purchased_classes_amount_ascending') }}</option>
                                    <option value="purchased_classes_amount_desc" @if(request()->get('sort') == 'purchased_classes_amount_desc') selected @endif>{{ trans('admin/main.purchased_classes_amount_descending') }}</option>


                                    <option value="purchased_appointments_asc" @if(request()->get('sort') == 'purchased_appointments_asc') selected @endif>{{ trans('admin/main.purchased_appointments_ascending') }}</option>
                                    <option value="purchased_appointments_desc" @if(request()->get('sort') == 'purchased_appointments_desc') selected @endif>{{ trans('admin/main.purchased_appointments_descending') }}</option>

                                    <option value="purchased_appointments_amount_asc" @if(request()->get('sort') == 'purchased_appointments_amount_asc') selected @endif>{{ trans('admin/main.purchased_appointments_amount_ascending') }}</option>
                                    <option value="purchased_appointments_amount_desc" @if(request()->get('sort') == 'purchased_appointments_amount_desc') selected @endif>{{ trans('admin/main.purchased_appointments_amount_descending') }}</option>

                                    <option value="register_asc" @if(request()->get('sort') == 'register_asc') selected @endif>{{ trans('admin/main.register_date_ascending') }}</option>
                                    <option value="register_desc" @if(request()->get('sort') == 'register_desc') selected @endif>{{ trans('admin/main.register_date_descending') }}</option>
                                </select>
                            </div>
                        </div> --}}


                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{ trans('admin/main.organization') }}</label>
                                <select name="organization_id" data-plugin-selectTwo class="form-control populate">
                                    <option value="">{{ trans('admin/main.select_organization') }}</option>
                                    @foreach($organizations as $organization)
                                        <option value="{{ $organization->id }}" @if(request()->get('organization_id') == $organization->id) selected @endif>{{ $organization->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{ trans('admin/main.users_group') }}</label>
                                <select name="group_id" data-plugin-selectTwo class="form-control populate">
                                    <option value="">{{ trans('admin/main.select_users_group') }}</option>
                                    @foreach($userGroups as $userGroup)
                                        <option value="{{ $userGroup->id }}" @if(request()->get('group_id') == $userGroup->id) selected @endif>{{ $userGroup->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Status</label>
                                <select name="status" data-plugin-selectTwo class="form-control populate">
                                    <option value="">Semua status</option>
                                    <option value="active_verified" @if(request()->get('status') == 'active_verified') selected @endif>Aktif (verifed)</option>
                                    <option value="active_notVerified" @if(request()->get('status') == 'active_notVerified') selected @endif>Aktif (not verifed)</option>
                                    <option value="inactive" @if(request()->get('status') == 'inactive') selected @endif>Tidak aktif</option>
                                    <option value="ban" @if(request()->get('status') == 'ban') selected @endif>Banned</option>
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
    </div>

    <div class="card">
        <div class="card-header">
            @can('admin_users_export_excel')
                <a href="{{ url('') }}/admin/students/excel?{{ http_build_query(request()->all()) }}" class="btn btn-primary">Export excel</a>
            @endcan
            <div class="h-10"></div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table table-striped font-14">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Pelatihan</th>
                        <th>Pertemuan</th>
                        {{-- <th>{{ trans('admin/main.wallet_charge') }}</th> --}}
                        {{-- <th>Grup pengguna</th> --}}
                        <th>Tanggal registrasi</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>

                    @foreach($users as $user)

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="text-left">
                                <div class="d-flex align-items-center">
                                    <figure class="avatar mr-2">
                                        <img src="{{ asset($user->getAvatar()) }}" alt="{{ $user->full_name }}">
                                    </figure>
                                    <div class="media-body ml-1">
                                        <div class="mt-0 mb-1 font-weight-bold">{{ $user->full_name }}</div>

                                        @if($user->mobile)
                                            <div class="text-primary text-small font-600-bold">{{ $user->mobile }}</div>
                                        @endif

                                        @if($user->email)
                                            <div class="text-primary text-small font-600-bold">{{ $user->email }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="media-body">
                                    <div class="text-primary mt-0 mb-1 font-weight-bold">{{ $user->classesPurchasedsCount }}</div>
                                    {{-- <div class="text-small font-600-bold">{{ addCurrencyToPrice(handlePriceFormat($user->classesPurchasedsSum)) }}</div> --}}
                                </div>
                            </td>

                            <td>
                                <div class="media-body">
                                    <div class="text-primary mt-0 mb-1 font-weight-bold">{{ $user->meetingsPurchasedsCount }}</div>
                                    {{-- <div class="text-small font-600-bold">{{ addCurrencyToPrice(handlePriceFormat($user->meetingsPurchasedsSum)) }}</div> --}}
                                </div>
                            </td>

                            {{-- <td>{{ addCurrencyToPrice($user->getAccountingBalance()) }}</td> --}}

                            {{-- <td>
                                {{ !empty($user->userGroup) ? $user->userGroup->group->name : '' }}
                            </td> --}}

                            <td>{{ dateTimeFormat($user->created_at, 'j M Y | H:i') }}</td>

                            <td>
                                @if($user->ban and !empty($user->ban_end_at) and $user->ban_end_at > time())
                                    <div class="mt-0 mb-1 font-weight-bold text-danger">Banned</div>
                                    <div class="text-small font-600-bold">Sampai {{ dateTimeFormat($user->ban_end_at, 'Y/m/j') }}</div>
                                @else
                                    <div class="mt-0 mb-1 font-weight-bold {{ ($user->status == 'active') ? 'text-success' : 'text-warning' }}">{{ $user->status }}</div>
                                @endif
                            </td>

                            <td class="text-center mb-2" width="120">
                                @can('admin_users_impersonate')
                                    <a href="{{ url('') }}/admin/users/{{ $user->id }}/impersonate" target="_blank" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Masuk">
                                        <i class="fa fa-user-shield"></i>
                                    </a>
                                @endcan

                                @can('admin_users_edit')
                                    <a href="{{ url('') }}/admin/users/{{ $user->id }}/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan

                                @can('admin_users_delete')
                                    @include('admin.includes.delete_button',['url' => '/admin/users/'.$user->id.'/delete' , 'btnClass' => ''])
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card-footer text-center">
            {{ $users->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>


    <section class="card">
        <div class="card-body">
            <div class="section-title ml-0 mt-0 mb-3"><h5>Petunjuk</h5></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Peserta baru</div>
                        <div class=" text-small font-600-bold">Anda dapat menambahkan peserta baru dari "Pengguna/Baru" atau mengisi formulir pendaftaran di bagian depan platform.</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">
                            Tertunda/Aktif</div>
                        <div class=" text-small font-600-bold">Pengguna yang memverifikasi email atau nomor telepon mereka akan dianggap sebagai "Aktif" dan pengguna yang tidak memverifikasi email atau telepon akan dianggap sebagai "Tertunda".</div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Tidak aktif/Ban</div>
                        <div class="text-small font-600-bold">Pengguna yang diblokir tidak akan dapat masuk untuk periode tertentu. Pengguna yang tidak aktif tidak akan bisa masuk sama sekali.</div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
