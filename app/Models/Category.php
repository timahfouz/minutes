<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [ 'id', ];
    
    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id')->withDefault();
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function section()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }
}
