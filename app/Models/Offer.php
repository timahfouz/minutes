<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = [ 'id', ];
    
    protected $casts = [ 'expired_at' => 'datetime' ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }
}
