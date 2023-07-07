@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a>Peserta</a></div>
                <div class="breadcrumb-item"><a href="#">{{ $pageTitle }}</a></div>
            </div>
        </div>
    </section>

    <div class="section-body">
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
                                <label class="input-label">Tanggal mulai</label>
                                <div class="input-group">
                                    <input type="date" id="from" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Tanggal akhir</label>
                                <div class="input-group">
                                    <input type="date" id="to" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                </div>
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
            @can('admin_users_not_access_content_toggle')
                <button type="button" id="addNewUserToNotaccess" class="btn btn-primary">Tambah baru</button>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table table-striped font-14">
                    <tr>
                        <th>ID</th>
                        <th class="text-left">Nama</th>
                        <th>Tangal registrasi</th>
                        <th>Status</th>
                        <th>
                            Akses Konten</th>
                        <th width="120">Aksi</th>
                    </tr>

                    @foreach($users as $user)

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="text-left">
                                <div class="d-flex align-items-center">
                                    <figure class="avatar mr-2">
                                        <img src="{{ $user->getAvatar() }}" alt="{{ $user->full_name }}">
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

                            <td>{{ dateTimeFormat($user->created_at, 'j M Y | H:i') }}</td>

                            <td>
                                @if($user->ban and !empty($user->ban_end_at) and $user->ban_end_at > time())
                                    <div class="mt-0 mb-1 font-weight-bold text-danger">Banned</div>
                                    <div class="text-small font-600-bold">Until {{ dateTimeFormat($user->ban_end_at, 'Y/m/j') }}</div>
                                @else
                                    <div class="mt-0 mb-1 font-weight-bold {{ ($user->status == 'active') ? 'text-success' : 'text-warning' }}">{{ $user->status }}</div>
                                @endif
                            </td>

                            <td>
                                <div class="mt-0 mb-1 font-weight-bold text-danger">Dibatasi</div>
                            </td>

                            <td class="text-center mb-2" width="120">
                                @can('admin_users_impersonate')
                                    <a href="/admin/users/{{ $user->id }}/impersonate" target="_blank" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Masuk">
                                        <i class="fa fa-user-shield"></i>
                                    </a>
                                @endcan

                                @can('admin_users_edit')
                                    <a href="/admin/users/{{ $user->id }}/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan

                                @can('admin_users_not_access_content_toggle')
                                    <a href="/admin/users/not-access-to-content/{{ $user->id }}/active" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Aktifkan">
                                        <i class="fa fa-arrow-up"></i>
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

    <div id="addUserToNotAccessModal" class="d-none">
        <h3 class="section-title after-line">Batasi Akses Konten</h3>
        <div class="mt-25">
            <form action="/admin/users/not-access-to-content/store" method="post">

                <div class="form-group">
                    <label class="input-label d-block">Pengguna</label>
                    <select name="user_id" class="form-control user-search" data-placeholder="Cari pengguna">

                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-3">
                    <button type="button" class="js-save-add-user-to-not-access btn btn-sm btn-primary">Simpan</button>
                    <button type="button" class="close-swl btn btn-sm btn-danger ml-2">Tutup</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>

    <script>
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
    </script>

    <script src="/assets/default/js/admin/not_access_to_content.min.js"></script>
@endpush
