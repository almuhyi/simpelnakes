<div id="descriptiveQuestionModal" class="{{ empty($question_edit) ? 'd-none' : ''}}">
    <div class="custom-modal-body">
        <h2 class="section-title after-line">Pertanyaan essay baru</h2>

        <div class="quiz-questions-form" data-action="/admin/quizzes-questions/{{ empty($question_edit) ? 'store' : $question_edit->id.'/update' }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="ajax[quiz_id]" value="{{ !empty($quiz) ? $quiz->id :'' }}">
            <input type="hidden" name="ajax[type]" value="{{ \App\Models\QuizzesQuestion::$descriptive }}">
            <div class="row mt-3">

                @if(!empty(getGeneralSettings('content_translate')))
                    <div class="col-12">
                        <div class="form-group">
                            <label class="input-label">Bahasa</label>
                            <select name="ajax[locale]"
                                    class="form-control {{ !empty($question_edit) ? 'js-quiz-question-locale' : '' }}"
                                    data-id="{{ !empty($question_edit) ? $question_edit->id : '' }}"
                            >
                                @foreach($userLanguages as $lang => $language)
                                    <option value="{{ $lang }}" {{ (!empty($question_edit) and !empty($question_edit->locale)) ? (mb_strtolower($question_edit->locale) == mb_strtolower($lang) ? 'selected' : '') : (app()->getLocale() == $lang ? 'selected' : '') }}>{{ $language }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="ajax[locale]" value="{{ $defaultLocale }}">
                @endif

                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label class="input-label">
                            Judul pertanyaan</label>
                        <input type="text" name="ajax[title]" class="js-ajax-title form-control" value="{{ !empty($question_edit) ? $question_edit->title : '' }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label class="input-label">Bobot nilai</label>
                        <input type="text" name="ajax[grade]" class="js-ajax-grade form-control" value="{{ !empty($question_edit) ? $question_edit->grade : '' }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="input-label">Gambar (Opsional)</label>

                        <div class="input-group mr-10">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text admin-file-manager" data-input="questionImageInput_{{ !empty($question_edit) ? $question_edit->id : 'record' }}" data-preview="holder">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            <input type="text" name="ajax[image]" id="questionImageInput_{{ !empty($question_edit) ? $question_edit->id : 'record' }}" value="{{ !empty($question_edit) ? $question_edit->image : '' }}" class="js-ajax-image form-control" placeholder=""/>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="input-label">Video (Opsional)</label>

                        <div class="input-group mr-10">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text admin-file-manager" data-input="questionVideoInput_{{ !empty($question_edit) ? $question_edit->id : 'record' }}" data-preview="holder">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            <input type="text" name="ajax[video]" id="questionVideoInput_{{ !empty($question_edit) ? $question_edit->id : 'record' }}" value="{{ !empty($question_edit) ? $question_edit->video : '' }}" class="js-ajax-video form-control" placeholder=""/>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="input-label">
                            Jawaban yang benar</label>
                        <textarea name="ajax[correct]" id="" class="js-ajax-correct form-control" rows="10">{{ !empty($question_edit) ? $question_edit->correct : '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end mt-3">
                <button type="button" class="save-question btn btn-sm btn-primary">Simpan</button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-2">Tutup</button>
            </div>
        </div>
    </div>
</div>
