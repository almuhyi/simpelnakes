<?php

namespace App\Models\Traits;

use App\Models\QuizzesResult;
use App\Models\Sale;
use App\Models\WebinarAssignmentHistory;
use App\Models\WebinarChapterItem;

trait SequenceContent
{
    protected $test = false;

    public function checkSequenceContent($test = false)
    {
        //$this->test = $test; // use for debug

        $user = auth()->user();
        $result = null; // null means user can access to this content

        if (!empty($user) and ($user->id == $this->creator_id or $user->isAdmin())) {
            return $result;
        }

        if (getFeaturesSettings('sequence_content_status')) {
            $chapter = $this->chapter;

            if (!empty($chapter)) {
                $previousChapters = $chapter->getPreviousContents();

                $result['all_passed_items_error'] = $this->checkChapterAllContentPassed($previousChapters);
            }

            if ($this->check_previous_parts and empty($result['all_passed_items_error'])) {
                $previousItems = $this->getPreviousContents();

                $result['all_passed_items_error'] = $this->checkAllPassedItems($previousItems);
            }

            if (!empty($this->access_after_day)) {
                $result['access_after_day_error'] = $this->checkAccessAfterDay();
            }
        }

        return $result;
    }

    public function getPreviousContents()
    {
        if ($this->table == 'webinar_chapters') {
            $previousItems = $this->getPreviousChapters();
        } else {
            $chapter = $this->chapter;

            $type = WebinarChapterItem::$chapterFile;

            if ($this->table == 'sessions') {
                $type = WebinarChapterItem::$chapterSession;
            } else if ($this->table == 'text_lessons') {
                $type = WebinarChapterItem::$chapterTextLesson;
            } else if ($this->table == 'quizzes') {
                $type = WebinarChapterItem::$chapterQuiz;
            } else if ($this->table == 'webinar_assignments') {
                $type = WebinarChapterItem::$chapterAssignment;
            }

            $currentItemOrder = WebinarChapterItem::where('user_id', $this->creator_id)
                ->where('item_id', $this->id)
                ->where('chapter_id', $this->chapter_id)
                ->where('type', $type)
                ->first();


            $previousItems = $this->getPreviousItemsByChapter($chapter, !empty($currentItemOrder) ? $currentItemOrder->order : null);

            if (empty($previousItems) or count($previousItems) < 1) {
                $previousChapters = $chapter->getPreviousContents();

                if (!empty($previousChapters) and count($previousChapters)) {
                    $previousChapter = $previousChapters->first();

                    $previousItems = $this->getPreviousItemsByChapter($previousChapter);
                }
            }
        }

        return $previousItems;
    }

    private function checkChapterAllContentPassed($chapters)
    {
        $result = null;

        if (!empty($chapters) and count($chapters)) {
            foreach ($chapters as $chapter) {
                if ($chapter->check_all_contents_pass) {
                    $chapterItems = $this->getPreviousItemsByChapter($chapter);

                    $chapterResult = $this->checkAllPassedItems($chapterItems);

                    if (!empty($chapterResult)) {
                        $result = 'Anda harus melewati bab sebelumnya untuk melihat isi bab ini.';;
                    }
                }
            }
        }

        return $result;
    }

    private function checkAccessAfterDay()
    {
        $result = null;
        $user = auth()->user();
        $day = $this->access_after_day;

        if (!empty($user)) {
            $sale = Sale::where('buyer_id', $user->id)
                ->where('webinar_id', $this->webinar_id)
                ->whereNull('refund_at')
                ->first();

            if (!empty($sale)) {
                $conditionDay = strtotime("+$day days", $sale->created_at);

                if (time() < $conditionDay) {
                    $result = 'Konten ini akan tersedia untuk Anda pada tanggal' . ' ' . dateTimeFormat($conditionDay, 'j M Y H:i');
                }
            } else {
                $result = 'Anda tidak memiliki akses ke konten ini!';
            }
        } else {
            $result = 'Silahkan login untuk mengakses konten.';
        }

        return $result;
    }

    private function checkAllPassedItems($chapterItems)
    {
        $userId = auth()->id();

        $result = null;

        foreach ($chapterItems as $chapterItem) {
            if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterSession and !empty($chapterItem->session)) {
                $item = $chapterItem->session;
            } else if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterFile and !empty($chapterItem->file)) {
                $item = $chapterItem->file;
            } else if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterTextLesson and !empty($chapterItem->textLesson)) {
                $item = $chapterItem->textLesson;
            } else if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterAssignment) {
                $item = $chapterItem->assignment;
            } else if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterQuiz) {
                $item = $chapterItem->quiz;
            }

            // Only check previous content that has the check_previous_parts enabled => Vahid Daghighy
            if (!empty($item)) {
                if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterSession or
                    $chapterItem->type == \App\Models\WebinarChapterItem::$chapterFile or
                    $chapterItem->type == \App\Models\WebinarChapterItem::$chapterTextLesson
                ) {
                    if (empty($item->learningStatus)) {
                        $result = 'Anda harus melewati pelajaran sebelumnya untuk melihat bagian ini.';
                    }
                } else if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterAssignment) {
                    $assignmentHistory = WebinarAssignmentHistory::where('assignment_id', $item->id)
                        ->where('student_id', $userId)
                        ->where('status', WebinarAssignmentHistory::$passed)
                        ->first();

                    if (empty($assignmentHistory)) {
                        $result = 'Anda harus melewati pelajaran sebelumnya untuk melihat bagian ini.';
                    }
                } else if ($chapterItem->type == \App\Models\WebinarChapterItem::$chapterQuiz) {
                    $quizHistory = QuizzesResult::where('quiz_id', $item->id)
                        ->where('user_id', $userId)
                        ->where('status', QuizzesResult::$passed)
                        ->first();

                    if (empty($quizHistory)) {
                        $result = 'Anda harus melewati pelajaran sebelumnya untuk melihat bagian ini.';
                    }
                }
            }
        }

        return $result;
    }

    private function getPreviousChapters()
    {
        $query = $this->newQuery();
        $query->where('webinar_id', $this->webinar_id);
        $query->where('status', 'active');

        if (!empty($this->order)) {
            $query->where(function ($query) {
                $query->whereNull('order')
                    ->orWhere('order', '<', $this->order);
            });
        } else {
            $query->whereNull('order');
            $query->where('id', '<', $this->id);
        }

        $query->orderBy('order', 'desc');
        $query->orderBy('id', 'desc');

        return $query->get();
    }

    private function getPreviousItemsByChapter($chapter, $currentItemOrder = null)
    {
        $query = $chapter->chapterItems();

        if (!empty($currentItemOrder)) {
            $query->where('order', '<', $currentItemOrder);
        }

        return $query->orderBy('order', 'desc')
            ->get();
    }

    /*private function getPreviousItems()
    {
        $currentItemOrder = WebinarChapterItem::where('user_id', $this->creator_id)
            ->where('item_id', $this->id)
            ->where('chapter_id', $this->chapter_id)
            ->first();

        $webinar = Webinar::where('id', $this->webinar_id)
            ->where(function ($query) {
                $query->where('creator_id', $this->creator_id)
                    ->orWhere('teacher_id', $this->creator_id);
            })
            ->first();

        if (!empty($webinar)) {
            $creatorIds = [$webinar->creator_id, $webinar->teacher_id];

            $query = $this->newQuery();
            $query->join('webinar_chapter_items', 'webinar_chapter_items.item_id', "{$this->table}.id");
            $query->select("{$this->table}.*", DB::raw('webinar_chapter_items.order as itemOrder'));
            $query->where("{$this->table}.chapter_id", $this->chapter_id);
            $query->where("{$this->table}.webinar_id", $this->webinar_id);
            $query->whereIn("{$this->table}.creator_id", $creatorIds);
            $query->where("webinar_chapter_items.chapter_id", $this->chapter_id);
            $query->whereIn("webinar_chapter_items.user_id", $creatorIds);
            $query->where('status', 'active');
            $query->where("{$this->table}.id", '!=', $this->id);

            if (!empty($currentItemOrder)) {
                $query->where("webinar_chapter_items.order", '<', $currentItemOrder->order);
            }

            $query->orderBy('itemOrder', 'desc');

            return $query->get();
        }

        return null;
    }*/
}
