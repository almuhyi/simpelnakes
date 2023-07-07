@if(!empty($file) and $file->storage == 'upload_archive')
    @include('admin.webinars.create_includes.accordions.new_interactive_file',['file' => $file])
@else
    <li data-id="{{ !empty($chapterItem) ? $chapterItem->id :'' }}" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
        <div class="d-flex align-items-center justify-content-between " role="tab" id="file_{{ !empty($file) ? $file->id :'record' }}">
            <div class="d-flex align-items-center" href="#collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-controls="collapseFile{{ !empty($file) ? $file->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="{{ !empty($file) ? $file->getIconByType() : 'file' }}" class=""></i>
            </span>

                <div class="font-weight-bold text-dark-blue d-block cursor-pointer">{{ !empty($file) ? $file->title . ($file->accessibility == 'free' ? " (". 'Gratis' .")" : '') : 'Tambah file baru' }}</div>
            </div>

            <div class="d-flex align-items-center">

                @if(!empty($file) and $file->status != \App\Models\WebinarChapter::$chapterActive)
                    <span class="disabled-content-badge mr-10">Tidak aktif</span>
                @endif

                @if(!empty($file))
                    <button type="button" data-item-id="{{ $file->id }}" data-item-type="{{ \App\Models\WebinarChapterItem::$chapterFile }}" data-chapter-id="{{ !empty($chapter) ? $chapter->id : '' }}" class="js-change-content-chapter btn btn-sm btn-transparent text-gray mr-10">
                        <i data-feather="grid" class="" height="20"></i>
                    </button>
                @endif

                <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

                @if(!empty($file))
                    <a href="/admin/files/{{ $file->id }}/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                        <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                    </a>
                @endif

                <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-controls="collapseFile{{ !empty($file) ? $file->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true"></i>
            </div>
        </div>

        <div id="collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-labelledby="file_{{ !empty($file) ? $file->id :'record' }}" class=" collapse @if(empty($file)) show @endif" role="tabpanel">
            <div class="panel-collapse text-gray">
                <div class="js-content-form file-form" data-action="/admin/files/{{ !empty($file) ? $file->id . '/update' : 'store' }}">
                    <input type="hidden" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][webinar_id]" value="{{ !empty($webinar) ? $webinar->id :'' }}">
                    <input type="hidden" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][chapter_id]" value="{{ !empty($chapter) ? $chapter->id :'' }}" class="chapter-input">

                    <div class="row">
                        <div class="col-12 col-lg-12">

                            @if(!empty(getGeneralSettings('content_translate')))
                                <div class="form-group">
                                    <label class="input-label">Bahasa</label>
                                    <select name="ajax[{{ !empty($file) ? $file->id : 'new' }}][locale]"
                                            class="form-control {{ !empty($file) ? 'js-webinar-content-locale' : '' }}"
                                            data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}"
                                            data-id="{{ !empty($file) ? $file->id : '' }}"
                                            data-relation="files"
                                            data-fields="title,description"
                                    >
                                        @foreach($userLanguages as $lang => $language)
                                            <option value="{{ $lang }}" {{ (!empty($file) and !empty($file->locale)) ? (mb_strtolower($file->locale) == mb_strtolower($lang) ? 'selected' : '') : (app()->getLocale() == $lang ? 'selected' : '') }}>{{ $language }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][locale]" value="{{ $defaultLocale }}">
                            @endif


                            <div class="form-group">
                                <label class="input-label">Judul</label>
                                <input type="text" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][title]" class="js-ajax-title form-control" value="{{ !empty($file) ? $file->title : '' }}" placeholder="Maksimal 255 karakter"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label class="input-label">
                                    Sumber</label>
                                <select name="ajax[{{ !empty($file) ? $file->id : 'new' }}][storage]"
                                        class="js-file-storage form-control"
                                >
                                    @foreach(\App\Models\File::$fileSources as $source)
                                        <option value="{{ $source }}" @if(!empty($file) and $file->storage == $source) selected @endif>{{ $source }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="input-label">
                                    Aksesibilitas</label>

                                <div class="d-flex align-items-center js-ajax-accessibility">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][accessibility]" value="free" @if(empty($file) or (!empty($file) and $file->accessibility == 'free')) checked="checked" @endif id="accessibilityRadio1_{{ !empty($file) ? $file->id : 'record' }}" class="custom-control-input">
                                        <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio1_{{ !empty($file) ? $file->id : 'record' }}">Gratis</label>
                                    </div>

                                    <div class="custom-control custom-radio ml-15">
                                        <input type="radio" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][accessibility]" value="paid" @if(!empty($file) and $file->accessibility == 'paid') checked="checked" @endif id="accessibilityRadio2_{{ !empty($file) ? $file->id : 'record' }}" class="custom-control-input">
                                        <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio2_{{ !empty($file) ? $file->id : 'record' }}">Berbayar</label>
                                    </div>
                                </div>

                                <div class="invalid-feedback"></div>
                            </div>


                            <div class="form-group js-file-path-input {{ (!empty($file) and $file->storage == 's3') ? 'd-none' : '' }}">
                                <div class="local-input input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text admin-file-manager " data-input="file_path{{ !empty($file) ? $file->id : 'record' }}" data-preview="holder">
                                            <i data-feather="upload" width="18" height="18" class=""></i>
                                        </button>
                                    </div>
                                    <input type="text" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][file_path]" id="file_path{{ !empty($file) ? $file->id : 'record' }}" value="{{ (!empty($file)) ? $file->file : '' }}" class="js-ajax-file_path form-control" placeholder="Unggah file dari PC anda"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-group js-s3-file-path-input {{ (!empty($file) and $file->storage == 's3') ? '' : 'd-none' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text text-white">
                                            <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][s3_file]" class="js-s3-file-input custom-file-input cursor-pointer" id="s3File{{ !empty($file) ? $file->id : 'record' }}">
                                        <label class="custom-file-label cursor-pointer" for="s3File{{ !empty($file) ? $file->id : 'record' }}">Pilih file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group js-file-type-volume d-none">
                                <div class="col-6">
                                    <label class="input-label">Jenis file</label>
                                    <select name="ajax[{{ !empty($file) ? $file->id : 'new' }}][file_type]" class="js-ajax-file_type form-control">
                                        <option value="">Pilih file</option>

                                        @foreach(\App\Models\File::$fileTypes as $fileType)
                                            <option value="{{ $fileType }}" @if(!empty($file) and $file->file_type == $fileType) selected @endif>{{ $fileType }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-6">
                                    <label class="input-label">Volume (MB)</label>
                                    <input type="text" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][volume]" value="{{ (!empty($file)) ? $file->volume : '' }}" class="js-ajax-volume form-control" placeholder="Tulis file volume (MB)"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="input-label">Deskripsi</label>
                                <textarea name="ajax[{{ !empty($file) ? $file->id : 'new' }}][description]" class="js-ajax-description form-control" rows="6">{{ !empty($file) ? $file->description : '' }}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="js-online_viewer-input form-group mt-20">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer input-label" for="online_viewerSwitch{{ !empty($file) ? $file->id : '_record' }}">
                                        Penampil daring</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][online_viewer]" class="custom-control-input" id="online_viewerSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (!empty($file) and $file->online_viewer) ? 'checked' : ''  }}>
                                        <label class="custom-control-label" for="online_viewerSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="js-downloadable-input form-group mt-20">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer input-label" for="downloadableSwitch{{ !empty($file) ? $file->id : '_record' }}">Dapat diunduh</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][downloadable]" class="custom-control-input" id="downloadableSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (empty($file) or $file->downloadable) ? 'checked' : ''  }}>
                                        <label class="custom-control-label" for="downloadableSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-20">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer input-label" for="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}">Aktif</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][status]" class="custom-control-input" id="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (empty($file) or $file->status == \App\Models\File::$Active) ? 'checked' : ''  }}>
                                        <label class="custom-control-label" for="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                    </div>
                                </div>
                            </div>

                            @if(getFeaturesSettings('sequence_content_status'))
                                <div class="form-group mt-20">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="cursor-pointer input-label" for="SequenceContentSwitch{{ !empty($file) ? $file->id : '_record' }}">Lainnya</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][sequence_content]" class="js-sequence-content-switch custom-control-input" id="SequenceContentSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (!empty($file) and ($file->check_previous_parts or !empty($file->access_after_day))) ? 'checked' : ''  }}>
                                            <label class="custom-control-label" for="SequenceContentSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="js-sequence-content-inputs pl-5 {{ (!empty($file) and ($file->check_previous_parts or !empty($file->access_after_day))) ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="cursor-pointer input-label" for="checkPreviousPartsSwitch{{ !empty($file) ? $file->id : '_record' }}">
                                                Paksa peserta untuk melewati bagian sebelumnya</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][check_previous_parts]" class="custom-control-input" id="checkPreviousPartsSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (empty($file) or $file->check_previous_parts) ? 'checked' : ''  }}>
                                                <label class="custom-control-label" for="checkPreviousPartsSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="input-label">
                                            Batas hari akses</label>
                                        <input type="number" name="ajax[{{ !empty($file) ? $file->id : 'new' }}][access_after_day]" value="{{ (!empty($file)) ? $file->access_after_day : '' }}" class="js-ajax-access_after_day form-control" placeholder="
                                        misalnya 10 untuk mengizinkan peserta mengakses bagian ini setelah 10 hari."/>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-30 d-flex align-items-center">
                        <button type="button" class="js-save-file btn btn-sm btn-primary">Simpan</button>

                        @if(empty($file))
                            <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">Tutup</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </li>

    @push('scripts_bottom')
        <script>
            var filePathPlaceHolderBySource = {
                upload: '{{ ('Unggah file dari PC Anda') }}',
            youtube: '{{ ('Tempel tautan Youtube') }}',
            vimeo: '{{ ('Tempel tautan Youtube') }}',
            external_link: '{{ ('Tempel tautan eksternal') }}',
            google_drive: '{{ ('Tautan pratinjau Drive (Sematan) dimulai dengan tag iframe') }}',
            dropbox: '{{ ('Tempel tautan dropbox') }}',
            iframe: '{{ ('Rekatkan seluruh kode iframe') }}',
            s3: '{{ ('Unggah file dari PC Anda ke S3') }}',
            }
        </script>
    @endpush
@endif
