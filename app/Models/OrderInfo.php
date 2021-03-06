<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;

    protected $guarded = [ 'id', ];
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id')->withDefault();
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id')->withDefault();
    }
}
