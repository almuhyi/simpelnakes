<!-- Modal -->
<div class="d-none" id="webinarFileModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Tambah file</h3>
    <form action="{{ url('/admin/files/store') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="webinar_id" value="{{  !empty($webinar) ? $webinar->id :''  }}">


        <div class="form-group">
            <label class="input-label">Judul</label>
            <input type="text" name="title" class="form-control" placeholder="Maksimal 255 karakter"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Bagian</label>
            <select class="custom-select" name="chapter_id">
                <option value="">
                    Tidak ada Bagian</option>

                @if(!empty($chapters))
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                    @endforeach
                @endif
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="input-label">Sumber</label>
                    <select name="storage"
                            class="js-file-storage form-control"
                    >
                        @foreach(\App\Models\File::$fileSources as $source)
                            <option value="{{ $source }}">{{ $source }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="input-label">Aksesibilitas</label>
                    <select class="custom-select" name="accessibility" required>
                        <option selected disabled>Pilih Aksesibiltas</option>
                        <option value="free">Gratis</option>
                        <option value="paid">Berbayar</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>

        <div class="form-group js-file-path-input">
            <div class="local-input input-group">
                <div class="input-group-prepend">
                    <button type="button" class="input-group-text admin-file-manager" data-input="file_path_record" data-preview="holder">
                        <i class="fa fa-upload"></i>
                    </button>
                </div>
                <input type="text" name="file_path" id="file_path_record" value="" class="js-ajax-file_path form-control" placeholder="Pilih file"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="form-group js-s3-file-path-input d-none">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="input-group-text">
                        <i class="fa fa-upload"></i>
                    </button>
                </div>
                <div class="custom-file">
                    <input type="file" name="s3_file" class="js-s3-file-input custom-file-input cursor-pointer" id="s3File_record">
                    <label class="custom-file-label cursor-pointer" for="s3File_record">Pilih file</label>
                    <div class="invalid-feedback" style="position: absolute;bottom: -20px"></div>
                </div>
            </div>
        </div>

        <div class="row form-group js-file-type-volume d-none">
            <div class="col-6">
                <label class="input-label">Jenis file</label>
                <select name="file_type" class="js-ajax-file_type form-control">
                    <option value="">Pilih jenis file</option>

                    @foreach(\App\Models\File::$fileTypes as $fileType)
                        <option value="{{ $fileType }}">{{ $fileType }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-6">
                <label class="input-label">
                    Volume (MB)</label>
                <input type="text" name="volume" value="" class="js-ajax-volume form-control" placeholder="Tulis volume file (MB)"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="input-label">Deskripsi</label>
            <textarea name="description" class="js-ajax-description form-control" rows="6"></textarea>
            <div class="invalid-feedback"></div>
        </div>

        <div class="js-online_viewer-input form-group mt-20">
            <div class="d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="online_viewerSwitch_record">Penampil daring</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="online_viewer" class="custom-control-input" id="online_viewerSwitch_record">
                    <label class="custom-control-label" for="online_viewerSwitch_record"></label>
                </div>
            </div>
        </div>

        <div class="js-downloadable-input form-group mt-20">
            <div class="d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="downloadableSwitch_record">Dapat diunduh</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="downloadable" class="custom-control-input" id="downloadableSwitch_record">
                    <label class="custom-control-label" for="downloadableSwitch_record"></label>
                </div>
            </div>
        </div>

        <div class="form-group mt-20">
            <div class="d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="fileStatusSwitch_record">Aktif</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" class="custom-control-input" id="fileStatusSwitch_record">
                    <label class="custom-control-label" for="fileStatusSwitch_record"></label>
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
            <button type="button" id="saveFile" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">Tutup</button>
        </div>
    </form>
</div>
