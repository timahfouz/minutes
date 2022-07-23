<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [ 'id', ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, CartItem::class, 'cart_id', 'product_id');
    }
}
