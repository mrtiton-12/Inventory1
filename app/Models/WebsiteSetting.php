<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
     
        'website_name',
        'website_phone',
        'website_address' ,
        'website_email' ,
        'currency' ,
        'header_logo',
    ];
}
