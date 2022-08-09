<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [ 'id', ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'carrier_id')->withDefault();
    }
    
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id')->withDefault();
    }
    
    public function info()
    {
        return $this->hasOne(OrderInfo::class, 'order_id')->withDefault([
            'commission' => 0,
            'delivery_fees' => 0,
        ]);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id')->withDefault();
    }

    public function catItems()
    {
        return CartItem::where('cart_id', $this->cart_id)->get();
    }

    public function items()
    {
        $orderId = $this->id;
        $url = env('APP_URL');

        return DB::table('orders')
            ->selectRaw("p.id as product_id, p.name, p.unit, p.price, CONCAT('$url','',media.path) as image_path, ci.qty")
            ->leftJoin('cart_items as ci', function($join) {
                $join->on('orders.cart_id','=','ci.cart_id');
            })
            ->leftJoin('products as p', function($join) {
                $join->on('ci.product_id','=','p.id');
            })
            ->leftJoin('media', function($join) {
                $join->on('p.image_id','=','media.id');
            })
            ->where('orders.id', $orderId)
            ->get();
    }
}
