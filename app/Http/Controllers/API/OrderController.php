<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\API\OrderRequest;
use App\Http\Resources\API\OrderResource;
use App\Http\Resources\API\OrderInfoResource;
use App\Http\Requests\API\SpecialOrderRequest;
use App\Pipelines\Criterias\FilterOrdersPipeline;

class OrderController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Order');
    }

    public function __invoke(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $userID = getUser()->id;

            $cart = $this->pipeline->setModel('Cart')->create(['user_id' => $userID]);
            
            $total_cost = 0;

            foreach($request->items as $item) {
                $price = 0.0;
                $unit = '';

                if (isset($item['product_id'])) {
                    $product = $this->pipeline->setModel('Product')->find($item['product_id']);
                    if ($product->in_stock < $item['qty']) {
                        throw new \Exception("$product->name has only {$product->in_stock} items in stock");
                    }
                    $product->decrement('in_stock', $item['qty']);
                    $price = $product->price;
                    $unit = $product->unit;
                }
                if (isset($item['offer_id'])) {
                    $offer = $this->pipeline->setModel('Offer')->find($item['offer_id']);
                    if ($offer->product->in_stock < $item['qty']) {
                        throw new \Exception("{$offer->product->name} has only {$offer->product->in_stock} items in stock");
                    }
                    $offer->product->decrement('in_stock', $item['qty']);
                    $item['product_id'] = $offer->product_id;
                    $price = $offer->new_price;
                    $unit = $offer->new_unit;
                }
                $item['price'] = $price;
                $item['unit'] = $unit;
                $total_cost += $price * $item['qty'];
                
                $data[] = $item;
            }
            $cart->items()->createMany($data);
            
            $orderData = [
                'cart_id' => $cart->id,
                'total_cost' => $total_cost,
                'user_id' => $userID
            ];

            if ($request->filled('coupon')) {
                $coupon = $this->pipeline->setModel('Coupon')->where('code', $request->coupon)->first();
                $orderData['coupon_id'] = $coupon->id;
                $orderData['coupon_value'] = $coupon->value;

                $disc = $coupon->value;
                if ($orderData['total_cost'] < $disc) {
                    $disc = $orderData['total_cost'];
                }
                $orderData['total_cost'] -= $disc;
            }
            
            
            $order = $this->pipeline->setModel('Order')->create($orderData);
            
            $cart->update(['is_ordered' => '1']);

            $settings = $this->pipeline->setModel('Setting')->whereIn('key', ['commission','delivery_fees'])
                ->pluck('value', 'key')->toArray();
            
            $this->pipeline->setModel('OrderInfo')->create([
                'order_id' => $order->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'extra_address' => $request->extra_address,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'commission' => $settings['commission'] ?? 0.0,
                'delivery_fees' => $settings['delivery_fees'] ?? 0.0,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return jsonResponse(400, $ex->getMessage());
        }
        
        return jsonResponse(201);
    }
    

    public function special(SpecialOrderRequest $request)
    {
        DB::beginTransaction();

        $total_cost = 0;
        $userId = getUser()->id;
        $data = [
            'user_id' => $userId,
            'is_special' => true
        ];
        
        try {

            $order = $this->pipeline->setModel('Order')->create($data);

            $settings = $this->pipeline->setModel('Setting')->whereIn('key', ['commission','delivery_fees'])
                ->pluck('value', 'key')->toArray();
            
            $image_id = null;

            if ($request->hasFile('image')) {
                $path = resizeImage($request->image, 'uploads', [300, 300]);
                $media = $this->pipeline->setModel('Media')->create(['path' => $path]);
                $image_id = $media->id;
            }

            $this->pipeline->setModel('OrderInfo')->create([
                'order_id' => $order->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'description' => $request->description,
                'image_id' => $image_id,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'commission' => $settings['commission'] ?? 0.0,
                'delivery_fees' => $settings['delivery_fees'] ?? 0.0,
            ]);

            DB::commit();
        } catch (\Exception $ex) {

            DB::rollback();
            return jsonResponse(400, $ex->getMessage());
        }
        return jsonResponse(201); 
    }
    
    public function index(Request $request)
    {
        $user = getUser();

        $this->pipeline->pushPipeline(new FilterOrdersPipeline($request));

        $orders = $this->pipeline->where('user_id', $user->id)->get();

        $response = OrderResource::collection($orders);

        return jsonResponse(200, 'done.', $response); 
    }
    
    public function show($id)
    {
        $user = getUser();

        $order = $this->pipeline->where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();
        
        if (!$order) {
            return jsonResponse(404, 'not found.'); 
        }

        $response = new OrderInfoResource($order);

        return jsonResponse(200, 'done.', $response); 
    }
    
    public function coupon($code)
    {
        $coupon = $this->pipeline->setModel('Coupon')->where('code', $code)->first();
        
        if (!$coupon) {
            return jsonResponse(404, 'not found.'); 
        }
        return jsonResponse(200, 'done.', $coupon);
    }
}
