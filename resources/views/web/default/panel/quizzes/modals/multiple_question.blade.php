<div id="multipleQuestionModal" class="@if(!empty($quiz)) multipleQuestionModal{{ $quiz->id }} @endif {{ empty($question_edit) ? 'd-none' : ''}}">
    <div class="custom-modal-body">
        <h2 class="section-title after-line">Pertanyaan pilihan ganda</h2>

        <div class="quiz-questions-form" data-action="{{ url('') }}/panel/quizzes-questions/{{ empty($question_edit) ? 'store' : $question_edit->id.'/update' }}">

            <input type="hidden" name="ajax[quiz_id]" value="{{ !empty($quiz) ? $quiz->id :'' }}">
            <input type="hidden" name="ajax[type]" value="{{ \App\Models\QuizzesQuestion::$multiple }}">

            <div class="row mt-25">

                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label class="input-label">Judul pertanyaan</label>
                        <input type="text" name="ajax[title]" class="js-ajax-title form-control" value="{{ !empty($question_edit) ? $question_edit->title : '' }}"/>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label class="input-label">Nilai</label>
                        <input type="text" name="ajax[grade]" class="js-ajax-grade form-control" value="{{ !empty($question_edit) ? $question_edit->grade : '' }}"/>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="input-label">Gambar (Opsional)</label>

                        <div class="input-group mr-10">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text panel-file-manager" data-input="questionImageInput_{{ !empty($question_edit) ? $question_edit->id : 'record' }}" data-preview="holder">
                                    <i data-feather="upload" width="18" height="18" class="text-white"></i>
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
                                <button type="button" class="input-group-text panel-file-manager" data-input="questionVideoInput_{{ !empty($question_edit) ? $question_edit->id : 'record' }}" data-preview="holder">
                                    <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                </button>
                            </div>
                            <input type="text" name="ajax[video]" id="questionVideoInput_{{ !empty($question_edit) ? $question_edit->id : 'record' }}" value="{{ !empty($question_edit) ? $question_edit->video : '' }}" class="js-ajax-video form-control" placeholder=""/>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
            <p class="font-12 text-gray col-12 pb-10">Anda hanya dapat mengisi salah satu bidang gambar atau video. Hindari mengisi keduanya.}</p>
            </div>

            <div class="mt-25">
                <h2 class="section-title after-line">Jawaban</h2>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-sm btn-primary mt-15 add-answer-btn">
                        Tambahkan Jawaban</button>

                    <div class="form-group">
                        <input type="hidden" name="ajax[current_answer]" class="js-ajax-current_answer "/>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
            </div>

            <div class="add-answer-container">

                @if (!empty($question_edit->quizzesQuestionsAnswers) and !$question_edit->quizzesQuestionsAnswers->isEmpty())
                    @foreach ($question_edit->quizzesQuestionsAnswers as $answer)
                        @include(getTemplate() .'.panel.quizzes.modals.multiple_answer_form',['answer' => $answer])
                    @endforeach
                @else
                    @include(getTemplate() .'.panel.quizzes.modals.multiple_answer_form')
                @endif
            </div>

            <div class="d-flex align-items-center justify-content-end mt-25">
                <button type="button" class="save-question btn btn-sm btn-primary">Simpan</button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-10">Tutup</button>
            </div>

        </div>
    </div>
</div>
