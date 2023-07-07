<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Profesi extends Model
{
    protected $table = 'profesi';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];


    use Sluggable;



}
