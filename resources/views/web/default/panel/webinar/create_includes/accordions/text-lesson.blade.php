<li data-id="{{ !empty($chapterItem) ? $chapterItem->id :'' }}" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
    <div class="d-flex align-items-center justify-content-between " role="tab" id="text_lesson_{{ !empty($textLesson) ? $textLesson->id :'record' }}">
        <div class="d-flex align-items-center" href="#collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" aria-controls="collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="file-text" class=""></i>
            </span>

            <div class="font-weight-bold text-dark-blue d-block">{{ !empty($textLesson) ? $textLesson->title . ($textLesson->accessibility == 'free' ? " (". 'Gratis' .")" : '') : 'Tambahkan pelajaran teks baru' }}</div>
        </div>

        <div class="d-flex align-items-center">

            @if(!empty($textLesson) and $textLesson->status != \App\Models\WebinarChapter::$chapterActive)
                <span class="disabled-content-badge mr-10">Nonaktifkan</span>
            @endif

            @if(!empty($textLesson))
                <button type="button" data-item-id="{{ $textLesson->id }}" data-item-type="{{ \App\Models\WebinarChapterItem::$chapterTextLesson }}" data-chapter-id="{{ !empty($chapter) ? $chapter->id : '' }}" class="js-change-content-chapter btn btn-sm btn-transparent text-gray mr-10">
                    <i data-feather="grid" class="" height="20"></i>
                </button>
            @endif

            <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

            @if(!empty($textLesson))
                <a href="{{ url('') }}/panel/text-lesson/{{ $textLesson->id }}/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                    <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                </a>
            @endif

            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" aria-controls="collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true"></i>
        </div>
    </div>

    <div id="collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" aria-labelledby="text_lesson_{{ !empty($textLesson) ? $textLesson->id :'record' }}" class=" collapse @if(empty($textLesson)) show @endif" role="tabpanel">
        <div class="panel-collapse text-gray">
            <div class="js-content-form text_lesson-form" data-action="{{ url('') }}/panel/text-lesson/{{ !empty($textLesson) ? $textLesson->id . '/update' : 'store' }}">
                <input type="hidden" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][webinar_id]" value="{{ !empty($webinar) ? $webinar->id :'' }}">
                <input type="hidden" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][chapter_id]" value="{{ !empty($chapter) ? $chapter->id :'' }}" class="chapter-input">

                <div class="row">
                    <div class="col-12 col-lg-12">
                        @if(!empty(getGeneralSettings('content_translate')))
                            <div class="form-group">
                                <label class="input-label">Bahasa</label>
                                <select name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][locale]"
                                        class="form-control {{ !empty($textLesson) ? 'js-webinar-content-locale' : '' }}"
                                        data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}"
                                        data-id="{{ !empty($textLesson) ? $textLesson->id : '' }}"
                                        data-relation="textLessons"
                                        data-fields="title,summary,content"
                                >
                                    @foreach($userLanguages as $lang => $language)
                                        <option value="{{ $lang }}" {{ (!empty($textLesson) and !empty($textLesson->locale)) ? (mb_strtolower($textLesson->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '') }}>{{ $language }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][locale]" value="{{ $defaultLocale }}">
                        @endif

                        <div class="form-group">
                            <label class="input-label">Judul</label>
                            <input type="text" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][title]" class="js-ajax-title form-control" value="{{ !empty($textLesson) ? $textLesson->title : '' }}" placeholder=""/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">
                                Waktu Belajar (Menit)</label>
                            <input type="number" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][study_time]" class="js-ajax-study_time form-control" value="{{ !empty($textLesson) ? $textLesson->study_time : '' }}" placeholder="Masukan dengan angka, misalkan 60"/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Gambar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager" data-input="image{{ !empty($textLesson) ? $textLesson->id :'record' }}" data-preview="holder">
                                        <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][image]" id="image{{ !empty($textLesson) ? $textLesson->id :'record' }}" value="{{ !empty($textLesson) ? $textLesson->image : '' }}" class="js-ajax-image form-control"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Aksesibilitas</label>

                            <div class="d-flex align-items-center js-ajax-accessibility">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][accessibility]" value="free" @if(empty($textLesson) or (!empty($textLesson) and $textLesson->accessibility == 'free')) checked="checked" @endif id="accessibilityRadio1_{{ !empty($textLesson) ? $textLesson->id : 'record' }}" class="custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio1_{{ !empty($textLesson) ? $textLesson->id : 'record' }}">Gratis</label>
                                </div>

                                <div class="custom-control custom-radio ml-15">
                                    <input type="radio" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][accessibility]" value="paid" @if(!empty($textLesson) and $textLesson->accessibility == 'paid') checked="checked" @endif id="accessibilityRadio2_{{ !empty($textLesson) ? $textLesson->id : 'record' }}" class="custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio2_{{ !empty($textLesson) ? $textLesson->id : 'record' }}">Berbayar</label>
                                </div>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label d-block">Lampiran</label>

                            @php
                                $textLessonAttachmentsFileIds = [];

                                if (!empty($textLesson)) {
                                    $textLessonAttachmentsFileIds = $textLesson->attachments->pluck('file_id')->toArray();
                                }
                            @endphp

                            <select class="js-ajax-attachments @if(empty($textLesson)) form-control @endif attachments-select2" multiple="multiple" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][attachments]" data-placeholder="Pilih file terkait sebagai lampiran pelajaran">
                                <option></option>

                                @if(!empty($webinar->files) and count($webinar->files))
                                    @foreach($webinar->files as $filesInfo)
                                        <option value="{{ $filesInfo->id }}" @if(!empty($textLesson) and in_array($filesInfo->id, $textLessonAttachmentsFileIds)) selected @endif>{{ $filesInfo->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Ringkasan</label>
                            <textarea name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][summary]" class="js-ajax-summary form-control" rows="6">{{ !empty($textLesson) ? $textLesson->summary : '' }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="input-label">Isi</label>
                            <div class="content-summernote js-ajax-file_path">
                                <textarea class="js-content-summernote form-control {{ !empty($textLesson) ? 'js-content-'.$textLesson->id : '' }}">{{ !empty($textLesson) ? $textLesson->content : '' }}</textarea>
                                <textarea name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][content]" class="js-hidden-content-summernote {{ !empty($textLesson) ? 'js-hidden-content-'.$textLesson->id : '' }} d-none">{{ !empty($textLesson) ? $textLesson->content : '' }}</textarea>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12">
                        <div class="form-group mt-20">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="cursor-pointer input-label" for="textLessonStatusSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}">Aktif</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][status]" class="custom-control-input" id="textLessonStatusSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}" {{ (empty($textLesson) or $textLesson->status == \App\Models\TextLesson::$Active) ? 'checked' : ''  }}>
                                    <label class="custom-control-label" for="textLessonStatusSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}"></label>
                                </div>
                            </div>
                        </div>

                        @if(getFeaturesSettings('sequence_content_status'))
                            <div class="form-group mt-20">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer input-label" for="SequenceContentSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}">Lanjutan</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][sequence_content]" class="js-sequence-content-switch custom-control-input" id="SequenceContentSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}" {{ (!empty($textLesson) and ($textLesson->check_previous_parts or !empty($textLesson->access_after_day))) ? 'checked' : ''  }}>
                                        <label class="custom-control-label" for="SequenceContentSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="js-sequence-content-inputs pl-5 {{ (!empty($textLesson) and ($textLesson->check_previous_parts or !empty($textLesson->access_after_day))) ? '' : 'd-none' }}">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="cursor-pointer input-label" for="checkPreviousPartsSwitch{{ !empty($file) ? $file->id : '_record' }}">
                                            Paksa peserta untuk melewati bagian sebelumnya</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][check_previous_parts]" class="custom-control-input" id="checkPreviousPartsSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}" {{ (empty($textLesson) or $textLesson->check_previous_parts) ? 'checked' : ''  }}>
                                            <label class="custom-control-label" for="checkPreviousPartsSwitch{{ !empty($textLesson) ? $textLesson->id : '_record' }}"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="input-label">Batas akses (hari)</label>
                                    <input type="number" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][access_after_day]" value="{{ (!empty($textLesson)) ? $textLesson->access_after_day : '' }}" class="js-ajax-access_after_day form-control" placeholder="misalnya '10' untuk mengizinkan peserta mengakses bagian ini setelah 10 hari."/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="mt-30 d-flex align-items-center">
                    <button type="button" class="js-save-text_lesson btn btn-sm btn-primary">Simpan</button>

                    @if(empty($textLesson))
                        <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">Tutup</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>
