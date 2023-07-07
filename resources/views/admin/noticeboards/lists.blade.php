@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>


        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form class="mb-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" class="form-control" name="search" value="{{ request()->get('search') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Tanggal mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Tanggal akhir</label>
                                    <div class="input-group">
                                        <input type="date" id="lsdate" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                    </div>
                                </div>
                            </div>

                            @if(!empty($isCourseNotice) and $isCourseNotice)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">Pengirim</label>

                                        <select name="sender_id" data-search-option="just_organization_and_teacher_role" class="form-control search-user-select2"
                                                data-placeholder="Cari pengguna">

                                            @if(!empty($sender))
                                                <option value="{{ $sender->id }}" selected>{{ $sender->full_name }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">Warna</label>
                                        <select name="color" data-plugin-selectTwo class="form-control populate">
                                            <option value="">Semua</option>

                                            @foreach(\App\Models\CourseNoticeboard::$colors as $color)
                                                <option value="{{ $color }}" @if(request()->get('color') == $color) selected @endif>{{ $color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">Pengirim</label>
                                        <select name="sender" data-plugin-selectTwo class="form-control populate">
                                            <option value="">Pilih pengirim</option>
                                            <option value="admin" @if(request()->get('sender') == 'admin') selected @endif>Admin</option>
                                            <option value="organizations" @if(request()->get('sender') == 'organizations') selected @endif>Organisasi</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">Jenis</label>
                                        <select name="type" data-plugin-selectTwo class="form-control populate">
                                            <option value="">Semua jenis</option>

                                            @foreach(\App\Models\Noticeboard::$adminTypes as $type)
                                                <option value="{{ $type }}" @if(request()->get('type') == $type) selected @endif>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-4">
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
                    @can('admin_noticeboards_send')
                        <div class="text-right">
                            <a href="/admin/{{ (!empty($isCourseNotice) and $isCourseNotice) ? 'course-noticeboards' : 'noticeboards' }}/send" class="btn btn-primary">Kirim pemberitahuan</a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped font-14" id="datatable-basic">

                            <tr>
                                <th class="text-left">Judul</th>

                                @if(!empty($isCourseNotice) and $isCourseNotice)
                                    <th class="text-left">Pelatihan</th>
                                @endif

                                <th class="text-center">Pengirim</th>

                                <th class="text-center">Pesan</th>

                                @if(!empty($isCourseNotice) and $isCourseNotice)
                                    <th class="text-center">Warna</th>
                                @else
                                    <th class="text-center">Jenis</th>
                                @endif

                                <th class="text-center">Tanggal dibuat</th>
                                <th>Aksi</th>
                            </tr>

                            @foreach($noticeboards as $noticeboard)
                                <tr>
                                    <td class="text-left">
                                        {{ $noticeboard->title }}
                                    </td>

                                    @if(!empty($isCourseNotice) and !empty($noticeboard->webinar))
                                        <td class="text-left">
                                            @if(!empty($noticeboard->webinar))
                                                <a href="/admin/webinars/{{ $noticeboard->webinar->id }}/edit" target="_blank" class="font-14 d-block">{{ $noticeboard->webinar->id }}-{{ truncate($noticeboard->webinar->title,32) }}</a>
                                            @endif
                                        </td>
                                    @endif

                                    <td class="text-center">
                                        @if(!empty($isCourseNotice))
                                            {{ $noticeboard->creator ? $noticeboard->creator->full_name : '-' }}
                                        @else
                                            {{ $noticeboard->sender }}
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <button type="button" data-item-id="{{ $noticeboard->id }}" class="js-show-description btn btn-outline-primary">Lihat</button>
                                        <input type="hidden" value="{{ nl2br($noticeboard->message) }}">
                                    </td>
                                    <td class="text-center">
                                        @if(!empty($isCourseNotice) and $isCourseNotice)
                                            {{ $noticeboard->color }}
                                        @else
                                            {{ $noticeboard->type }}
                                        @endif
                                    </td>

                                    <td class="text-center">{{ dateTimeFormat($noticeboard->created_at,'j M Y | H:i') }}</td>

                                    <td width="100">
                                        @can('admin_noticeboards_edit')
                                            <a href="/admin/{{ (!empty($isCourseNotice) and $isCourseNotice) ? 'course-noticeboards' : 'noticeboards' }}/{{ $noticeboard->id }}/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('admin_notifications_delete')
                                            @include('admin.includes.delete_button',['url' => '/admin/'. ((!empty($isCourseNotice) and $isCourseNotice) ? "course-noticeboards" : "noticeboards" .'/'. $noticeboard->id).'/delete','btnClass' => ''])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $noticeboards->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="notificationMessageModal" tabindex="-1" aria-labelledby="notificationMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationMessageLabel">Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/js/admin/noticeboards.min.js"></script>
@endpush
