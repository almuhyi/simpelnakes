<!-- Modal -->
<div class="d-none" id="webinarAssignmentModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Tambah tugas baru</h3>
    <form action="/admin/assignments/store" method="post">
        <input type="hidden" name="webinar_id" value="{{  !empty($webinar) ? $webinar->id :''  }}">

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
            <label class="input-label">Judul</label>
            <input type="text" name="title" class="form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">
                Bagian</label>
            <select class="custom-select" name="chapter_id">
                @if(!empty($chapters))
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                    @endforeach
                @endif
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Deskripsi</label>
            <div class="content-summernote js-ajax-description">
                <textarea name="description" rows="5" class="form-control"></textarea>
            </div>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Nilai</label>
            <input type="text" name="grade" class="form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Nilai lulus</label>
            <input type="text" name="pass_grade" class="form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Batas waktu</label>
            <input type="text" name="deadline" class="form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Lampiran</label>
            <input type="text" name="attempts" class="form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="js-assignment-attachments-items form-group mt-15">
            <div class="d-flex align-items-center justify-content-between">
                <label class="input-label mb-0">Lampiran</label>

                <button type="button" class="btn btn-primary btn-sm assignment-attachments-add-btn">
                    <i class="fa fa-plus"></i>
                </button>
            </div>

            <div class="assignment-attachments-main-row js-ajax-attachments position-relative">
                <div class="mt-2 p-2 border rounded">
                    <div class="mb-2">
                        <label class="input-label">Judul</label>
                        <input type="text" name="attachments[assignmentTemp][title]" class="form-control" placeholder="maximal 255 karakter"/>
                    </div>

                    <div class="input-group product-images-input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text admin-file-manager" data-input="attachments_assignmentTemp" data-preview="holder">
                                <i class="fa fa-upload"></i>
                            </button>
                        </div>
                        <input type="text" name="attachments[assignmentTemp][attach]" id="attachments_assignmentTemp" value="" class="form-control" placeholder="Pilih lampiran"/>
                    </div>
                </div>

                <button type="button" class="btn btn-danger btn-sm assignment-attachments-remove-btn d-none">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <div class="invalid-feedback"></div>

            <div class="js-assignment-attachments-lists"></div>
        </div>

        <div class="js-textLesson-status form-group mt-3">
            <div class="d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="textLessonStatusSwitch_record">Aktif</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="textLessonStatusSwitch_record">
                    <label class="custom-control-label" for="textLessonStatusSwitch_record"></label>
                </div>
            </div>
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
                        <label class="cursor-pointer input-label" for="checkPreviousPartsSwitch_record">
                            Paksa peserta untuk melewati bagian sebelumnya</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" checked name="check_previous_parts" class="custom-control-input" id="checkPreviousPartsSwitch_record">
                            <label class="custom-control-label" for="checkPreviousPartsSwitch_record"></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="input-label">Batas hari akses</label>
                    <input type="number" name="access_after_day" value="" class="js-ajax-access_after_day form-control" placeholder="misalnya 10 untuk mengizinkan peserta mengakses bagian ini setelah 10 hari"/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        @endif

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveAssignment" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">Tutup</button>
        </div>
    </form>
</div>
