@php
    $checkSequenceContent = $item->checkSequenceContent(true);
   $sequenceContentHasError = (!empty($checkSequenceContent) and (!empty($checkSequenceContent['all_passed_items_error']) or !empty($checkSequenceContent['access_after_day_error'])));
@endphp


<div class="{{ (!empty($checkSequenceContent) and $sequenceContentHasError) ? 'js-sequence-content-error-modal' : 'tab-item' }} p-10 cursor-pointer {{ $class ?? '' }}"
     data-type="{{ $type }}"
     data-id="{{ $item->id }}"
     data-passed-error="{{ !empty($checkSequenceContent['all_passed_items_error']) ? $checkSequenceContent['all_passed_items_error'] : '' }}"
     data-access-days-error="{{ !empty($checkSequenceContent['access_after_day_error']) ? $checkSequenceContent['access_after_day_error'] : '' }}"
>

    <div class="d-flex align-items-center">
        <span class="chapter-icon bg-gray300 mr-10">
            <i data-feather="award" class="text-gray" width="16" height="16"></i>
        </span>

        <div class="flex-grow-1">
            <span class="font-weight-500 font-14 text-dark-blue d-block">{{ $item->title }}</span>

            <div class="d-flex align-items-center justify-content-between">
                <span class="font-12 text-gray d-block">
                    @if(!empty($item->time))
                        {{ $item->time .' '. ('Minimal') }}
                    @else
                        Waktu tidak terbatas
                    @endif

                    {{ ($item->quizQuestions ? ' | ' . $item->quizQuestions->count() .' '. ('Pertanyaan') : '') }}
                </span>

                @if(!empty($quiz->result_status))
                    @if($quiz->result_status == 'passed')
                        <span class="font-12 text-primary">Lulus</span>
                    @elseif($quiz->result_status == 'failed')
                        <span class="font-12 text-danger">Gagal</span>
                    @elseif($quiz->result_status == 'waiting')
                        <span class="font-12 text-warning">Menunggu</span>
                    @endif
                @endif
            </div>
        </div>

    </div>
</div>
