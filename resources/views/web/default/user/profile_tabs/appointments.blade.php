@if(!empty($meeting) and !empty($meeting->meetingTimes) and $meeting->meetingTimes->count() > 0)
    @push('styles_top')
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/wrunner-html-range-slider-with-2-handles/css/wrunner-default-theme.css">
    @endpush

    <div class="mt-40">
        <h3 class="font-16 font-weight-bold text-dark-blue">Klik pada hari dan lihat waktu yang tersedia</h3>

        <div class="mt-35">
            <div class="row align-items-center justify-content-center">
                <input type="hidden" id="inlineCalender" class="form-control">
                <div class="inline-reservation-calender"></div>
            </div>
        </div>
    </div>

    <div class="pick-a-time d-none" id="PickTimeContainer" data-user-id="{{ $user["id"] }}">

        <div class="d-flex align-items-center my-40 rounded-lg border px-10 py-5">
            <div class="appointment-timezone-icon">
                <img src="{{ asset('') }}assets/default/img/icons/timezone.svg" alt="appointment timezone">
            </div>
            <div class="ml-15">
                <div class="font-16 font-weight-bold text-dark-blue">Catatan:</div>
                <p class="font-14 font-weight-500 text-gray"> Semua slot waktu ditampilkan dalam zona waktu {{ $meetingTimezone .' '. toGmtOffset($meetingTimezone) }}</p>
            </div>
        </div>


        <div class="loading-img d-none text-center">
            <img src="{{ asset('') }}assets/default/img/loading.gif" width="80" height="80">
        </div>

        <form action="{{ url((!$meeting->disabled) ? '/meetings/reserve' : '') }}" method="post" id="PickTimeBody" class="d-none">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="day" id="selectedDay" value="">

            <h3 class="font-16 font-weight-bold text-dark-blue">
                @if($meeting->disabled)
                    Tidak tersedia
                @else
                    Pilih waktu
                    @if(!empty($meeting) and !empty($meeting->discount) and !empty($meeting->amount) and $meeting->amount > 0)
                        <span class="badge badge-danger text-white font-12">{{ $meeting->discount }}% Off</span>
                    @endif
                @endif
            </h3>

            <div class="d-flex flex-column mt-10">
                @if($meeting->disabled)
                    <span class="font-14 text-gray">Pesan ketidaktersediaan</span>
                @else
                    <span class="d-block font-14 text-gray font-weight-500">
                        Biaya per jam instruktur untuk pertemuan online adalah
                        @if(!empty($meeting->amount) and $meeting->amount > 0)
                            @if(!empty($meeting->discount))
                                <span class="text-decoration-line-through">{{ handlePrice($meeting->amount) }}</span>
                                <span class="text-primary">{{ handlePrice($meeting->amount - (($meeting->amount * $meeting->discount) / 100)) }}</span>
                            @else
                                <span class="text-primary">{{ handlePrice($meeting->amount) }}</span>
                            @endif
                        @else
                            <span class="text-primary">Gratis</span>
                        @endif
                    </span>

                    @if($meeting->in_person)
                    <span class="d-block font-14 text-gray font-weight-500">
                        Biaya instruktur per jam untuk pertemuan tatap muka adalah
                        @if(!empty($meeting->in_person_amount) and $meeting->in_person_amount > 0)
                            @if(!empty($meeting->discount))
                                <span class="text-decoration-line-through">{{ handlePrice($meeting->in_person_amount) }}</span>
                                <span class="text-primary">{{ handlePrice($meeting->in_person_amount - (($meeting->in_person_amount * $meeting->discount) / 100)) }}</span>
                            @else
                                <span class="text-primary">{{ handlePrice($meeting->in_person_amount) }}</span>
                            @endif
                        @else
                            <span class="text-primary">Gratis</span>
                        @endif
                    </span>
                  @endif
                  @if($meeting->group_meeting)
                    <span class="d-block font-14 text-gray font-weight-500">Instruktur ini dapat melakukan pertemuan kelompok dengan peserta minimal {{ $meeting->online_group_min_student, $meeting->online_group_max_student }} peserta</span>
                  @endif

                @endif

                <span class="font-14 text-gray mt-5 selected_date font-weight-500">Tanggal yang dipilih: <span></span></span>
            </div>

            @if(!$meeting->disabled)
                <div id="availableTimes" class="d-flex flex-wrap align-items-center mt-25">

                </div>

                <div class="js-time-description-card d-none mt-25 rounded-sm border p-10">

                </div>

                <div class="mt-25 d-none js-finalize-reserve">
                    <h3 class="font-16 font-weight-bold text-dark-blue">Selesaikan pertemuan Anda</h3>
                    <span class="selected-date-time font-14 text-gray font-weight-500">Waktu pertemuan: <span></span></span>

                    <div class="mt-15">
                        <span class="font-16 font-weight-500 text-dark-blue">Jenis pertemuan</span>

                        <div class="d-flex align-items-center mt-5">
                            <div class="meeting-type-reserve position-relative">
                                <input type="radio" name="meeting_type" id="meetingTypeInPerson" value="in_person">
                                <label for="meetingTypeInPerson">Pertemuan langsung</label>
                            </div>

                            <div class="meeting-type-reserve position-relative">
                                <input type="radio" name="meeting_type" id="meetingTypeOnline" value="online">
                                <label for="meetingTypeOnline">Online</label>
                            </div>
                        </div>
                    </div>

                    @if($meeting->group_meeting)
                        <div class="js-group-meeting-switch d-none align-items-center mt-20">
                            <label class="mb-0 mr-10 text-gray font-14 font-weight-500 cursor-pointer"
                                   for="withGroupMeetingSwitch">Pertemuan grup</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="with_group_meeting" class="custom-control-input"
                                       id="withGroupMeetingSwitch">
                                <label class="custom-control-label" for="withGroupMeetingSwitch"></label>
                            </div>
                        </div>

                        <div class="js-group-meeting-options d-none mt-15">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <input type="hidden" id="online_group_max_student" value="{{ $meeting->online_group_max_student }}">
                                        <input type="hidden" id="in_person_group_max_student" value="{{ $meeting->in_person_group_max_student }}">
                                        <label for="studentCountRange" class="form-label">Berpartisipasi:</label>
                                        <div
                                            class="range"
                                            id="studentCountRange"
                                            data-minLimit="1"
                                        >
                                            <input type="hidden" name="student_count" value="1">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="js-online-group-amount d-none font-14 font-weight-500 mt-15">
                                <span class="text-gray d-block">Tarif per jam pertemuan grup secara online adalah {{ addCurrencyToPrice($meeting->online_group_amount) }} per peserta</span>
                                <span class="text-danger mt-5 d-block">Kapasitas pertemuan kelompok minimal adalah {{ $meeting->online_group_min_student, $meeting->online_group_max_student }} peserta.</span>
                                <span class="text-danger mt-5 d-block">Kapasitas pertemuan kelompok maksimum adalah {{ $meeting->online_group_max_student }} peserta.</span>
                            </div>

                            @if($meeting->in_person)
                            <div class="js-in-person-group-amount d-none font-14 font-weight-500 mt-15">
                                <span class="text-gray d-block">Tarif per jam untuk pertemuan grup secara tatap muka adalah {{ addCurrencyToPrice($meeting->in_person_group_amount) }} per peserta</span>
                                <span class="text-danger mt-5 d-block">Kapasitas pertemuan kelompok minimal adalah {{ $meeting->in_person_group_min_student, $meeting->in_person_group_max_student }} peserta.</span>
                                <span class="text-danger mt-5 d-block">Kapasitas pertemuan kelompok maksimum adalah {{ $meeting->in_person_group_max_student }} peserta.</span>
                            </div>
                            @endif

                        </div>
                    @endif
                </div>

                <div class="js-reserve-description d-none form-group mt-30">
                    <label class="input-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Deskripsi (optional)"></textarea>
                </div>

                <div class="js-reserve-btn d-none align-items-center justify-content-end mt-30">
                    <button type="button" class="js-submit-form btn btn-primary">Reservasi pertemuan</button>
                </div>
            @endif
        </form>
    </div>

    @push('scripts_bottom')
        <script src="{{ asset('') }}assets/vendors/wrunner-html-range-slider-with-2-handles/js/wrunner-jquery.js"></script>
    @endpush
@else

    @include(getTemplate() . '.includes.no-result',[
       'file_name' => 'meet.png',
       'title' => ('Instruktur tidak tersedia untuk pertemuan...'),
       'hint' => '',
    ])

@endif
