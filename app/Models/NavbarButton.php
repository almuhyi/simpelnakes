<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavbarButton extends Model
{

    protected $table = 'navbar_buttons';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }
}
