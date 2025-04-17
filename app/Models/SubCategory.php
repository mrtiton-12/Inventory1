<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table    = 'sub_categories';
    public $timestamps  = true;
    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
