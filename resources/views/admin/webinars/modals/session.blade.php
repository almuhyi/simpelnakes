<!-- Modal -->
<div class="d-none" id="webinarSessionModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Sesi baru</h3>

    <form action="{{ url('/admin/sessions/store') }}" method="post" class="session-form">
        <input type="hidden" name="webinar_id" value="{{ !empty($webinar) ? $webinar->id :''  }}">

        @if(!empty(getGeneralSettings('content_translate')))
            <div class="form-group">
                <label class="input-label">Bahasa</label>
                <select name="locale" class="form-control ">
                    @foreach($userLanguages as $lang => $language)
                        <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
                    @endforeach
                </select>
                @error('locale')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        @else
            <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
        @endif


        <div class="form-group">
            <label class="input-label">Pilih penyedia kelas langsung (live)</label>

            <div class="js-session-api">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="localApi_record" value="local" checked class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="localApi_record">Custom</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="bigBlueButton_record" value="big_blue_button" class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="bigBlueButton_record">BigBlueButton</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="zoomApi_record" value="zoom" class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="zoomApi_record">Zoom</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="agoraApi_record" value="agora" class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="agoraApi_record">In-App live class</label>
                </div>
            </div>

            <div class="invalid-feedback"></div>

            <div class="js-zoom-not-complete-alert mt-10 text-danger d-none">
                Lengkapi pengaturan Zoom Anda untuk membuat sesi langsung.
            </div>
        </div>

        <div class="form-group">
            <label class="input-label">Bagian</label>
            <select class="custom-select" name="chapter_id">
                <option value="">Tidak ada bagian</option>

                @if(!empty($chapters))
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                    @endforeach
                @endif
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group js-api-secret">
            <label class="input-label">Kata sandi</label>
            <input type="text" name="api_secret" class="js-ajax-api_secret form-control" value=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group js-moderator-secret d-none">
            <label class="input-label">Kata sandi moderator</label>
            <input type="text" name="moderator_secret" class="js-ajax-moderator_secret form-control" value=""/>
            <div class="invalid-feedback"></div>
        </div>


        <div class="form-group">
            <label class="input-label">Judul</label>
            <input type="text" name="title" class="form-control" placeholder="Maksimal 255 karakter"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Tanggal</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="dateRangeLabel">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <input type="text" name="date" class="js-ajax-date form-control datetimepicker" aria-describedby="dateRangeLabel"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="input-label">Durasi <span class="braces">(Menit)</span></label>
            <input type="text" name="duration" class="js-ajax-duration form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Waktu Tunda Kelas live <span class="braces">(Menit)</span></label>
            <input type="text" name="extra_time_to_join" class="js-ajax-extra_time_to_join form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group js-local-link">
            <label class="input-label">Tautan</label>
            <input type="text" name="link" class="js-ajax-link form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="6"></textarea>
            <div class="invalid-feedback"></div>
        </div>

        <div class="js-session-status form-group mt-3">
            <div class="d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="sessionStatusSwitch_record">Akrif</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="sessionStatusSwitch_record">
                    <label class="custom-control-label" for="sessionStatusSwitch_record"></label>
                </div>
            </div>
        </div>

        <div class="js-agora-chat-and-rec d-none">
            @if(getFeaturesSettings('agora_chat'))
                <div class="form-group mt-20">
                    <div class="d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="sessionAgoraChatSwitch_record">Pesan</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="agora_chat" class="custom-control-input" id="sessionAgoraChatSwitch_record">
                            <label class="custom-control-label" for="sessionAgoraChatSwitch_record"></label>
                        </div>
                    </div>
                </div>
            @endif

            {{--
                <div class="form-group mt-20">
                    <div class="d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="sessionAgoraRecordSwitch_record">{{ trans('update.record') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="agora_record" class="custom-control-input" id="sessionAgoraRecordSwitch_record" >
                            <label class="custom-control-label" for="sessionAgoraRecordSwitch_record"></label>
                        </div>
                    </div>
                </div>
            --}}

        </div>

        @if(getFeaturesSettings('sequence_content_status'))
            <div class="form-group mb-1">
                <div class="d-flex align-items-center justify-content-between">
                    <label class="cursor-pointer input-label" for="SequenceContentSwitch_record">Lainnya</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="sequence_content" class="js-sequence-content-switch custom-control-input" id="SequenceContentSwitch_record">
                        <label class="custom-control-label" for="SequenceContentSwitch_record"></label>
                    </div>
                </div>
            </div>

            <div class="js-sequence-content-inputs pl-2 d-none">
                <div class="form-group mb-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="checkPreviousPartsSwitch_record">Paksa peserta untuk melewati bagian sebelumnya</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" checked name="check_previous_parts" class="custom-control-input" id="checkPreviousPartsSwitch_record">
                            <label class="custom-control-label" for="checkPreviousPartsSwitch_record"></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="input-label">Batas hari akses</label>
                    <input type="number" name="access_after_day" value="" class="js-ajax-access_after_day form-control" placeholder="misalnya 10 untuk mengizinkan peserta mengakses bagian ini setelah 10 hari."/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        @endif

        <div class="mt-3 d-flex align-items-center justify-content-end">
            <button type="button" id="saveSession" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">Tutup</button>
        </div>
    </form>
</div>
