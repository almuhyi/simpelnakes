<div class="">
    <div data-action="{{ url(!empty($quiz) ? '/panel/quizzes/'. $quiz->id .'/update' : '/panel/quizzes/store') }}" class="js-content-form quiz-form webinar-form">

        <section>
            <h2 class="section-title after-line">{{ !empty($quiz) ? ('Edit'.' ('. $quiz->title .')') : 'Kuis baru' }}</h2>

            <div class="row">
                <div class="col-12 col-md-12">

                    @if(!empty(getGeneralSettings('content_translate')))
                        <div class="form-group mt-25">
                            <label class="input-label">Bahasa</label>
                            <select name="ajax[locale]"
                                    class="form-control {{ !empty($quiz) ? 'js-webinar-content-locale' : '' }}"
                                    data-webinar-id="{{ !empty($quiz) ? $quiz->webinar_id : '' }}"
                                    data-id="{{ !empty($quiz) ? $quiz->id : '' }}"
                                    data-relation="quizzes"
                                    data-fields="title"
                            >
                                @foreach($userLanguages as $lang => $language)
                                    <option value="{{ $lang }}" {{ (!empty($quiz) and !empty($quiz->locale)) ? (mb_strtolower($quiz->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '') }}>{{ $language }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="ajax[locale]" value="{{ $defaultLocale }}">
                    @endif

                    @if(empty($selectedWebinar))
                        <div class="form-group mt-25">
                            <label class="input-label">Pelatihan</label>
                            <select name="ajax[webinar_id]" class="js-ajax-webinar_id custom-select">
                                <option {{ !empty($quiz) ? 'disabled' : 'selected disabled' }} value="">Pilih pelatihan</option>
                                @foreach($webinars as $webinar)
                                    <option value="{{ $webinar->id }}" {{  (!empty($quiz) and $quiz->webinar_id == $webinar->id) ? 'selected' : '' }}>{{ $webinar->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="ajax[webinar_id]" value="{{ $selectedWebinar->id }}">
                    @endif

                    @if(!empty($chapter) or !empty($webinarChapterPages))
                        <input type="hidden" name="ajax[chapter_id]" value="{{ !empty($chapter) ? $chapter->id :'' }}" class="chapter-input">
                    @else
                        <div class="form-group mt-25">
                            <label class="input-label">Bagian</label>

                            <select name="ajax[chapter_id]" class="js-ajax-chapter_id custom-select">
                                <option value="">Tidak ada Bagian</option>

                                @if(!empty($chapters) and count($chapters))
                                    @foreach($chapters as $chapter)
                                        <option value="{{ $chapter->id }}" {{  (!empty($quiz) and $quiz->chapter_id == $chapter->id) ? 'selected' : '' }}>{{ $chapter->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif

                    <div class="form-group @if(!empty($selectedWebinar)) mt-25 @endif">
                        <label class="input-label">Judul kuis</label>
                        <input type="text" value="{{ !empty($quiz) ? $quiz->title : old('title') }}" name="ajax[title]" class="js-ajax-title form-control @error('title')  is-invalid @enderror" placeholder=""/>
                        <div class="invalid-feedback">
                            @error('title')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Waktu<span class="braces">(Menit)</span></label>
                        <input type="number" value="{{ !empty($quiz) ? $quiz->time : old('time') }}" name="ajax[time]" class="js-ajax-time form-control @error('time')  is-invalid @enderror" placeholder="Biarkan kosong untuk waktu tidak terbatas."/>
                        <div class="invalid-feedback">
                            @error('time')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Jumlah percobaan</label>
                        <input type="number" name="ajax[attempt]" value="{{ !empty($quiz) ? $quiz->attempt : old('attempt') }}" class="js-ajax-attempt form-control @error('attempt')  is-invalid @enderror" placeholder="Biarkan kosong untuk percobaan tidak terbatas."/>
                        <div class="invalid-feedback">
                            @error('attempt')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Nilai lulus</label>
                        <input type="number" name="ajax[pass_mark]" value="{{ !empty($quiz) ? $quiz->pass_mark : old('pass_mark') }}" class="js-ajax-pass_mark form-control @error('pass_mark')  is-invalid @enderror" placeholder=""/>
                        <div class="invalid-feedback">
                            @error('pass_mark')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-20 d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="certificateSwitch{{ !empty($quiz) ? $quiz->id : 'record' }}">Sertifikat disertakan</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="ajax[certificate]" class="js-ajax-certificate custom-control-input" id="certificateSwitch{{ !empty($quiz) ? $quiz->id : 'record' }}" {{ !empty($quiz) && $quiz->certificate ? 'checked' : ''}}>
                            <label class="custom-control-label" for="certificateSwitch{{ !empty($quiz) ? $quiz->id : 'record' }}"></label>
                        </div>
                    </div>

                    <div class="form-group mt-20 d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="statusSwitch{{ !empty($quiz) ? $quiz->id : 'record' }}">Aktif</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="ajax[status]" class="js-ajax-status custom-control-input" id="statusSwitch{{ !empty($quiz) ? $quiz->id : 'record' }}" {{ (!empty($quiz) && $quiz->status == 'active') ? 'checked' : ''}}>
                            <label class="custom-control-label" for="statusSwitch{{ !empty($quiz) ? $quiz->id : 'record' }}"></label>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        @if(!empty($quiz))
            <section class="mt-30">
                <div class="d-block d-md-flex justify-content-between align-items-center pb-20">
                    <h2 class="section-title after-line">Pertanyaan</h2>

                    <div class="d-flex align-items-center mt-20 mt-md-0">
                        <button id="add_multiple_question" data-quiz-id="{{ $quiz->id }}" type="button" class="quiz-form-btn btn btn-primary btn-sm ml-10">Tambahkan pilihan ganda</button>
                        <button id="add_descriptive_question" data-quiz-id="{{ $quiz->id }}" type="button" class="quiz-form-btn btn btn-primary btn-sm ml-10">Tambahkan Deskriptif</button>
                    </div>
                </div>

                @if($quizQuestions)
                    @foreach($quizQuestions as $question)
                        <div class="quiz-question-card d-flex align-items-center mt-20">
                            <div class="flex-grow-1">
                                <h4 class="question-title">{{ $question->title }}</h4>
                                <div class="font-12 mt-5 question-infos">
                                    <span>{{ $question->type === App\Models\QuizzesQuestion::$multiple ? 'Pilihan ganda' : 'Deskriptif' }} | Nilai: {{ $question->grade }}</span>
                                </div>
                            </div>

                            <div class="btn-group dropdown table-actions">
                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical" height="20"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" data-question-id="{{ $question->id }}" class="edit_question btn btn-sm btn-transparent d-block">Edit</button>
                                    <a href="{{ url('') }}/panel/quizzes-questions/{{ $question->id }}/delete" class="delete-action btn btn-sm btn-transparent d-block">Hapus</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>
        @endif

        <input type="hidden" name="ajax[is_webinar_page]" value="@if(!empty($inWebinarPage) and $inWebinarPage) 1 @else 0 @endif">

        <div class="mt-20 mb-20">
            <button type="button" class="js-submit-quiz-form btn btn-sm btn-primary">{{ !empty($quiz) ? 'Simpan' : 'Buat' }}</button>

            @if(empty($quiz) and !empty($inWebinarPage))
                <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">Tutup</button>
            @endif
        </div>
    </div>

    <!-- Modal -->
@if(!empty($quiz))
    @include(getTemplate() .'.panel.quizzes.modals.multiple_question',['quiz' => $quiz])
    @include(getTemplate() .'.panel.quizzes.modals.descriptive_question',['quiz' => $quiz])
@endif
