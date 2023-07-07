<?php
    $itemHistory = $item->getAssignmentHistoryByStudentId(request()->get('student', $user->id));

    $checkSequenceContent = $item->checkSequenceContent();
    $sequenceContentHasError = (!empty($checkSequenceContent) and (!empty($checkSequenceContent['all_passed_items_error']) or !empty($checkSequenceContent['access_after_day_error'])));

    $assignmentUrl = "{$course->getLearningPageUrl()}?type=assignment&item={$item->id}";
    $assignmentUrlTarget = "_self";
    if ($course->isOwner($user->id)) {
        $assignmentUrl = "/panel/assignments/{$item->id}/students";
        $assignmentUrlTarget = "_blank";
    } elseif ($user->isAdmin()) {
        $assignmentUrl = "#!";
    }
?>

<a href="<?php echo e(url((!empty($checkSequenceContent) and $sequenceContentHasError) ? '#!' : $assignmentUrl)); ?>" target="<?php echo e($assignmentUrlTarget); ?>" class=" d-flex align-items-start p-10 cursor-pointer <?php echo e((!empty($checkSequenceContent) and $sequenceContentHasError) ? 'js-sequence-content-error-modal' : 'tab-item'); ?> <?php echo e($user->isAdmin() ? 'js-not-access-toast' : ''); ?>"
   data-type="assignment"
   data-id="<?php echo e($item->id); ?>"
   data-passed-error="<?php echo e(!empty($checkSequenceContent['all_passed_items_error']) ? $checkSequenceContent['all_passed_items_error'] : ''); ?>"
   data-access-days-error="<?php echo e(!empty($checkSequenceContent['access_after_day_error']) ? $checkSequenceContent['access_after_day_error'] : ''); ?>"
>

        <span class="chapter-icon bg-gray300 mr-10">
            <i data-feather="feather" class="text-gray" width="16" height="16"></i>
        </span>

    <div>
        <div class="">
            <span class="font-weight-500 font-14 text-dark-blue d-block"><?php echo e($item->title); ?></span>
            <?php if(empty($itemHistory) or ($itemHistory->status == \App\Models\WebinarAssignmentHistory::$notSubmitted)): ?>
                <span class="text-danger font-12 d-block">Tugas belum dikumpulkan</span>
            <?php else: ?>
                <?php switch($itemHistory->status):
                    case (\App\Models\WebinarAssignmentHistory::$passed): ?>
                    <span class="text-primary font-12 d-block">Lulus</span>
                    <?php break; ?>
                    <?php case (\App\Models\WebinarAssignmentHistory::$pending): ?>
                    <span class="text-warning font-12 d-block">Tertunda</span>
                    <?php break; ?>
                    <?php case (\App\Models\WebinarAssignmentHistory::$notPassed): ?>
                    <span class="font-12 d-block text-danger">Gagal</span>
                    <?php break; ?>
                <?php endswitch; ?>
            <?php endif; ?>
        </div>


        <div class="tab-item-info mt-15">
            <p class="font-12 text-gray d-block">
                <?php echo truncate($item->description, 150); ?>

            </p>

            <div class="d-block mt-10 font-12 text-gray">
                <span class="">Tenggat waktu: </span>
                <?php if(!empty($item->deadline)): ?>
                    <?php echo e(dateTimeFormat($item->getDeadlineTimestamp(), 'j M Y')); ?>

                <?php else: ?>
                    <span>Tak terbatas</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</a>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/course/learningPage/components/content_tab/assignment-content-tab.blade.php ENDPATH**/ ?>