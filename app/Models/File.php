<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\SequenceContent;

class File extends Model
{
    use SequenceContent;

    public $timestamps = false;
    protected $table = 'files';
    protected $guarded = ['id'];

    static $accessibility = [
        'free', 'paid'
    ];

    static $videoTypes = ['mp4', 'mkv', 'avi', 'mov', 'wmv', 'avchd', 'flv', 'f4v', 'swf', 'mpeg-2', 'webm', 'video'];
    static $fileTypes = [
        'pdf', 'powerpoint', 'sound', 'video', 'image', 'archive', 'document', 'project'
    ];

    static $fileSources = [
        'upload', 'youtube', 'vimeo', 'external_link', 'google_drive', 'iframe', 's3'
    ];

    static $Active = 'active';
    static $Inactive = 'inactive';
    static $fileStatus = ['active', 'inactive'];


    public function chapter()
    {
        return $this->belongsTo('App\Models\WebinarChapter', 'chapter_id', 'id');
    }

    public function learningStatus()
    {
        return $this->hasOne('App\Models\CourseLearning', 'file_id', 'id');
    }

    public function isVideo()
    {
        return (in_array($this->file_type, self::$videoTypes));
    }

    public function getFileDuration()
    {
        $duration = 0;

        if ($this->storage == 'upload') {
            $file_path = public_path($this->file);

            $getID3 = new \getID3;
            $file = $getID3->analyze($file_path);

            if (!empty($file) and !empty($file['playtime_seconds'])) {
                $duration = $file['playtime_seconds'];
            }
        }

        return convertMinutesToHourAndMinute($duration);
    }

    public function getIconByType($type = null)
    {
        $icon = 'file';

        if (empty($type)) {
            $type = $this->file_type;
        }

        if (!empty($type)) {
            if (in_array($type, ['pdf', 'powerpoint', 'document'])) {
                $icon = 'file-text';
            } else if (in_array($type, ['sound'])) {
                $icon = 'volume-2';
            } else if (in_array($type, ['video'])) {
                $icon = 'film';
            } else if (in_array($type, ['image'])) {
                $icon = 'image';
            } else if (in_array($type, ['archive'])) {
                $icon = 'archive';
            }
        }

        return $icon;
    }
}
