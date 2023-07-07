<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Ticket extends Model implements TranslatableContract
{
    use Translatable;

    public $timestamps = false;
    protected $table = 'tickets';
    protected $guarded = ['id'];

    public $translatedAttributes = ['title'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    public function isValid()
    {
        $now = time();
        $ticket = $this;
        $valid = true;

        if ($ticket->start_date > $now or $this->end_date < $now) {
            $valid = false;
        }

        if ($ticket->capacity) {
            $ticketUserCount = TicketUser::where('ticket_id', $ticket->id)->count();

            if ($ticketUserCount and $ticket->capacity <= $ticketUserCount) {
                $valid = false;
            }
        }

        return $valid;
    }

    public function getSubTitle()
    {
        $title = '';

        if (!empty($this->end_date) and !empty($this->capacity)) {
            $title = 'untuk' . ' ' . $this->capacity . ' ' . 'peserta pertama hingga' . dateTimeFormat($this->end_date, 'j F Y');
        } elseif (!empty($this->end_date)) {
            $title = 'sampai' . ' ' . dateTimeFormat($this->end_date, 'j F Y');
        }

        return $title;
    }
}
