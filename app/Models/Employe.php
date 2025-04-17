<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = "employes";
    public $timestamps = true;

    protected $fillable = [
        'employe_name',
        'employe_phone',
        'employe_email',
        'experience',
        'employe_image',
        'employe_designation'
    ];
}
