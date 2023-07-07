<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class WebinarExtraDescription extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'webinar_extra_descriptions';
    public $timestamps = false;
    protected $guarded = ['id'];

    static $types = ['Materi', 'Logo', 'Persyaratan'];
    static $LEARNING_MATERIALS = 'Materi';
    static $COMPANY_LOGOS = 'Logo';
    static $REQUIREMENTS = 'Persyaratan';

    public $translatedAttributes = ['value'];

    public function getValueAttribute()
    {
        return getTranslateAttributeValue($this, 'value');
    }

}
