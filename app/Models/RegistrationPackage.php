<?php

namespace App\Models;

use App\Mixins\RegistrationPackage\UserPackage;
use Illuminate\Database\Eloquent\Model;

class RegistrationPackage extends Model
{

    protected $table = 'registration_packages';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    public function sales()
    {
        return $this->hasMany('App\Models\Sale','registration_package_id','id');
    }
}
