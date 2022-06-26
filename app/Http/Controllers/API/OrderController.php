<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\API\OrderRequest;
use App\Http\Resources\API\OrderResource;
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
            $user = getUser();
            $cart = $this->pipeline->setModel('Cart')->where([
                'id' => $request->cart_id,
                'user_id' => $user->id,
                'status' => 'preview'
            ])->first();
            
            if (!$cart) {
                return jsonResponse(404, 'not found!'); 
            }
            $points = 0;
            foreach($cart->items as $item) {
                $points += $item->points_per_piece * $item->qty;
            }
            
            $this->pipeline->setModel('Order')->create([
                'user_id' => getUser()->id,
                'cart_id' => $request->cart_id,
                'total_points' => $points
            ]);
            
            $user->increment('points', $points);
            
            $cart->update(['status' => 'checkedout']);

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

        $response = new OrderResource($order);

        return jsonResponse(200, 'done.', $response); 
    }

    public function last()
    {
        $user = getUser();

        $order = $this->pipeline->where([
            'user_id' => $user->id
        ])->orderBy('id', 'desc')->first();

        if (!$order) {
            return jsonResponse(404, 'not found.'); 
        }
        
        $response = new OrderResource($order);

        return jsonResponse(200, 'done.', $response); 
    }
}
