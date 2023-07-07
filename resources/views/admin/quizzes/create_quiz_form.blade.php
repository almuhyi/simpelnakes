<div data-action="{{ !empty($quiz) ? '/admin/quizzes/'. $quiz->id .'/update' : '/admin/quizzes/store' }}" class="js-content-form quiz-form webinar-form">
    {{ csrf_field() }}
    <section>

        <div class="row">
            <div class="col-12 col-md-12">

                <div class="d-flex align-items-center justify-content-between">
                    <div class="">
                        <h2 class="section-title">{{ !empty($quiz) ? 'Edit' . (' ('. $quiz->title .') ') : 'Kuis baru' }}</h2>
                        <p>Instruktur: {{ $creator->full_name }}</p>
                    </div>
                </div>

                @if(!empty(getGeneralSettings('content_translate')))
                    <div class="form-group">
                        <label class="input-label">Bahasa</label>
                        <select name="ajax[locale]" class="form-control {{ !empty($quiz) ? 'js-edit-content-locale' : '' }}">
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

                @if(empty($selectedWebinar))
                    <div class="form-group mt-3">
                        <label class="input-label">Pelatihan</label>
                        <select name="ajax[webinar_id]" class="custom-select">
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

                <div class="form-group">
                    <label class="input-label">Judul kuis</label>
                    <input type="text" value="{{ !empty($quiz) ? $quiz->title : old('title') }}" name="ajax[title]" class="form-control @error('title')  is-invalid @enderror" placeholder=""/>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label">Waktu <span class="braces">(Menit)</span></label>
                    <input type="text" value="{{ !empty($quiz) ? $quiz->time : old('time') }}" name="ajax[time]" class="form-control @error('time')  is-invalid @enderror" placeholder="biarkan kosong untuk waktu tidak terbatas"/>
                    @error('time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label">Jumlah percobaan</label>
                    <input type="text" name="ajax[attempt]" value="{{ !empty($quiz) ? $quiz->attempt : old('attempt') }}" class="form-control @error('attempt')  is-invalid @enderror" placeholder="biarkan kosong untuk jumlah percobaan tidak terbatas"/>
                    @error('attempt')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label">Nilai lulus</label>
                    <input type="text" name="ajax[pass_mark]" value="{{ !empty($quiz) ? $quiz->pass_mark : old('pass_mark') }}" class="form-control @error('pass_mark')  is-invalid @enderror" placeholder=""/>
                    @error('pass_mark')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group mt-4 d-flex align-items-center justify-content-between">
                    <label class="cursor-pointer" for="certificateSwitch">Sertifikat disertakan</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="ajax[certificate]" class="custom-control-input" id="certificateSwitch" {{ !empty($quiz) && $quiz->certificate ? 'checked' : ''}}>
                        <label class="custom-control-label" for="certificateSwitch"></label>
                    </div>
                </div>

                <div class="form-group mt-4 d-flex align-items-center justify-content-between">
                    <label class="cursor-pointer" for="statusSwitch">Kuis aktif</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="ajax[status]" class="custom-control-input" id="statusSwitch" {{ !empty($quiz) && $quiz->status ? 'checked' : ''}}>
                        <label class="custom-control-label" for="statusSwitch"></label>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @if(!empty($quiz))
        <section class="mt-5">
            <div class="d-flex justify-content-between align-items-center pb-20">
                <h2 class="section-title after-line">Pertanyaan</h2>
                <button id="add_multiple_question" type="button" class="btn btn-primary btn-sm ml-2 mt-3">Tambah pilihan ganda</button>
                <button id="add_descriptive_question" type="button" class="btn btn-primary btn-sm ml-2 mt-3">Tambah essay / deskriptif</button>
            </div>
            @if($quizQuestions)
                @foreach($quizQuestions as $question)
                    <div class="quiz-question-card d-flex align-items-center mt-4">
                        <div class="flex-grow-1">
                            <h4 class="question-title">{{ $question->title }}</h4>
                            <div class="font-12 mt-3 question-infos">
                                <span>{{ $question->type === App\Models\QuizzesQuestion::$multiple ? 'Pilihan ganda' : 'Essay' }} | {{ 'Nilai' }}: {{ $question->grade }}</span>
                            </div>
                        </div>

                        <div class="btn-group dropdown table-actions">
                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu text-left">
                                <button type="button" data-question-id="{{ $question->id }}" class="edit_question btn btn-sm btn-transparent">Edit</button>
                                @include('admin.includes.delete_button',['url' => '/admin/quizzes-questions/'. $question->id .'/delete', 'btnClass' => 'btn-sm btn-transparent' , 'btnText' => 'Hapus'])
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

@if(!empty($quiz))
    @include('admin.quizzes.modals.multiple_question')
    @include('admin.quizzes.modals.descriptive_question')
@endif
