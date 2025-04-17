<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = [
     'category_name',
     'category_slug'
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
