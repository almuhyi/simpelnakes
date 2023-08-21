<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Unit extends Model
{
    protected $table = 'unit';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    static $cacheKey = 'unit';

    public function user()
    {
        return $this->hasMany('App\User', 'unit_id', 'id');
    }


}
