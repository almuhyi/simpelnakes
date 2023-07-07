@extends('admin.layouts.app')

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

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-address-book"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total pertemuan</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalAppointments }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-clock"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pertemuan yang dibuka</h4>
                        </div>
                        <div class="card-body">
                            {{ $openAppointments }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pertemuan selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ $finishedAppointments }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>
                                Total Reservator</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalConsultants }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
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
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua status</option>
                                        <option value="{{ \App\Models\ReserveMeeting::$open }}" @if(request()->get('status') == \App\Models\ReserveMeeting::$open) selected @endif>Dibuka</option>
                                        <option value="{{ \App\Models\ReserveMeeting::$finished }}" @if(request()->get('status') == \App\Models\ReserveMeeting::$finished) selected @endif>Selesai</option>
                                        <option value="{{ \App\Models\ReserveMeeting::$canceled }}" @if(request()->get('status') == \App\Models\ReserveMeeting::$canceled) selected @endif>Dibatalkan</option>
                                        <option value="{{ \App\Models\ReserveMeeting::$pending }}" @if(request()->get('status') == \App\Models\ReserveMeeting::$pending) selected @endif>Tertunda</option>
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.filters')}}</label>
                                    <select name="sort" data-plugin-selectTwo class="form-control populate">
                                        <option value="">{{trans('admin/main.filter_type')}}</option>
                                        <option value="has_discount" @if(request()->get('sort') == 'has_discount') selected @endif>{{trans('admin/main.discounted_appointments')}}</option>
                                        <option value="free" @if(request()->get('sort') == 'free') selected @endif>{{trans('admin/main.free_appointments')}}</option>
                                        <option value="amount_asc" @if(request()->get('sort') == 'amount_asc') selected @endif>{{trans('admin/main.cost_ascending')}}</option>
                                        <option value="amount_desc" @if(request()->get('sort') == 'amount_desc') selected @endif>{{trans('admin/main.cost_descending')}}</option>
                                        <option value="date_asc" @if(request()->get('sort') == 'date_asc') selected @endif>{{trans('admin/main.date_ascending')}}</option>
                                        <option value="date_desc" @if(request()->get('sort') == 'date_desc') selected @endif>{{trans('admin/main.date_descending')}}</option>
                                    </select>
                                </div>
                            </div> --}}


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Instruktur</label>

                                    <select name="consultant_ids[]" multiple="multiple" data-search-option="consultants" class="form-control search-user-select2"
                                            data-placeholder="Search Consultants">

                                        @if(!empty($consultants) and $consultants->count() > 0)
                                            @foreach($consultants as $teacher)
                                                <option value="{{ $teacher->id }}" selected>{{ $teacher->full_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Reservator</label>

                                    <select name="user_ids[]" multiple="multiple" class="form-control search-user-select2"
                                            data-placeholder="Search Reservatores">

                                        @if(!empty($users) and $users->count() > 0)
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" selected>{{ $user->full_name }}</option>
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

            <section class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center font-14">

                            <tr>
                                <th class="text-left">Instruktur</th>
                                <th class="text-left">Reservator</th>
                                <th class="text-center">Jenis pertemuan</th>
                                {{-- <th class="text-center">{{trans('admin/main.cost')}}</th> --}}
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Jumlah peserta</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>

                            @foreach($appointments as $appointment)
                                <tr>
                                    <td class="text-left">
                                        <a href="{{ $appointment->meeting->creator->getProfileUrl() }}" target="_blank">{{ $appointment->meeting->creator->full_name }}</a>
                                    </td>

                                    <td class="text-left">
                                        <a href="{{ $appointment->user->getProfileUrl() }}" target="_blank">{{ $appointment->user->full_name }}</a>
                                    </td>

                                    <td class="text-center">
                                        <span class="">{{ $appointment->meeting_type }}</span>
                                    </td>

                                    {{-- <td>
                                        <div class="media-body">
                                            <div class=" mt-0 mb-1 font-weight-bold">{{ addCurrencyToPrice(handlePriceFormat($appointment->paid_amount)) }}</div>
                                        </div>
                                    </td> --}}

                                    <td class="text-center">{{ dateTimeFormat($appointment->start_at, 'j M Y') }}</td>

                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center">
                                            <span class="">{{ dateTimeFormat($appointment->start_at, 'H:i') }}</span>
                                            <span class="mx-1">-</span>
                                            <span class="">{{ dateTimeFormat($appointment->end_at, 'H:i') }}</span>
                                        </div>
                                    </td>

                                    <td class="align-middle font-weight-500">
                                        {{ $appointment->student_count ?? 1 }}
                                    </td>

                                    <td class="text-center">
                                        @switch($appointment->status)
                                            @case(\App\Models\ReserveMeeting::$pending)
                                            <span class="text-primary">Tertunda</span>
                                            @break
                                            @case(\App\Models\ReserveMeeting::$open)
                                            <span class="text-warning">Dibuka</span>
                                            @break
                                            @case(\App\Models\ReserveMeeting::$finished)
                                            <span class="text-success">Selesai</span>
                                            @break
                                            @case(\App\Models\ReserveMeeting::$canceled)
                                            <span class="text-danger">Dibatalkan</span>
                                            @break
                                        @endswitch
                                    </td>

                                    <td class="text-center" width="50">
                                        <input type="hidden" class="js-meeting-password" value="{{ $appointment->password }}">
                                        <input type="hidden" class="js-meeting-link" value="{{ $appointment->link }}">

                                        @can('admin_appointments_join')
                                            @if(!empty($appointment->link) and $appointment->status == \App\Models\ReserveMeeting::$open)
                                                <button type="button" data-reserve-id="{{ $appointment->id }}" class="js-show-join-modal btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Gabung"><i class="fa fa-link" aria-hidden="true"></i></button>
                                            @endif
                                        @endcan

                                        @can('admin_appointments_send_reminder')
                                            <button type="button" data-reserve-id="{{ $appointment->id }}" class="js-send-reminder btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Kirim pengingat"><i class="fa fa-bell" aria-hidden="true"></i></button>
                                        @endcan

                                        @can('admin_appointments_cancel')
                                            @if($appointment->status != \App\Models\ReserveMeeting::$canceled)
                                                @include('admin.includes.delete_button',['url' => '/admin/appointments/'.$appointment->id.'/cancel'])
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $appointments->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </section>
        </div>
    </section>


     <section class="card">
        <div class="card-body">
           <div class="section-title ml-0 mt-0 mb-3"> <h5>Petunjuk</h5> </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Pertemuan Selesai/Tertunda</div>
                        <div class=" text-small font-600-bold">Pertemuan yang melewati waktunya dan konsultan mengubah statusnya menjadi selesai, akan dianggap sebagai "Selesai" dan rapat yang dicadangkan tetapi belum dimulai akan dianggap sebagai "Tertunda".</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Pertemuan yang Dibatalkan</div>
                        <div class=" text-small font-600-bold">Admin atau Staf dapat membatalkan pertemuan. Pertemuan tidak dapat dibatalkan oleh konsultan atau reservasi.</div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">
                            Pertemuan dibuka</div>
                        <div class="text-small font-600-bold">Pertemuan yang "Bergabung dengan URL" ditentukan oleh konsultan dan sedang dalam proses.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="joinModal" tabindex="-1" aria-labelledby="contactMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactMessageLabel">Gabung pertemuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label class="input-label">Tautan</label>
                                <input type="text" name="link" class="form-control" disabled/>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="input-label">Kata sandi</label>
                                <input type="text" name="password" class="form-control" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="" target="_blank" class="js-join-btn btn btn-primary">Gabung</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sendReminderModal" tabindex="-1" aria-labelledby="contactMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactMessageLabel">Kirim pengingat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <strong>Instruktur:</strong>
                        <span class="js-consultant"></span>
                    </div>

                    <div class="mt-2">
                        <strong>Reservator:</strong>
                        <span class="js-reservatore"></span>
                    </div>

                    <div class="mt-2">
                        <strong>Judul pengingat:</strong>
                        <span class="js-title"></span>
                    </div>

                    <div class="mt-2">
                        <strong>Pesan:</strong>
                        <span class="js-message"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="" class="js-send-reminder-btn btn btn-primary">Kirim</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/js/admin/appointments.min.js"></script>
@endpush
