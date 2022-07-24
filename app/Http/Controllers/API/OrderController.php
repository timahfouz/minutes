<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\API\OrderRequest;
use App\Http\Resources\API\OrderResource;
use App\Http\Resources\API\OrderInfoResource;
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

        
        $total_cost = 0;
        $userId = getUser()->id;
        $data = [
            'user_id' => $userId,
            'cart_id' => $request->cart_id
        ];
        
        try {
            
            $cart = $this->pipeline->setModel('Cart')->where([
                'id' => $request->cart_id,
                'user_id' => $userId,
                'is_ordered' => 0
            ])->first();

            if (!$cart) {
                return jsonResponse(404, 'not found!'); 
            }
            
            foreach($cart->items as $item) {
                $total_cost += $item->price * $item->qty;
            }

            if ($request->filled('coupon')) {
                $coupon = $this->pipeline->setModel('Coupon')->where('code', $request->coupon)->first();
                $data['coupon_id'] = $coupon->id;
                $data['coupon_value'] = $coupon->value;

                $total_cost -= $coupon->value;
            }
            
            $data['total_cost'] = $total_cost;

            $order = $this->pipeline->setModel('Order')->create($data);
            
            $cart->update(['is_ordered' => '1']);

            $settings = $this->pipeline->setModel('Setting')->whereIn('key', ['commission','delivery_fees'])
                ->pluck('value', 'key')->toArray();
            
            $this->pipeline->setModel('OrderInfo')->create([
                'order_id' => $order->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
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
    
}
