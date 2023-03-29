<?php

namespace App\Http\Controllers\API\Carrier;

use Illuminate\Http\Request;
use App\Http\Resources\API\OrderResource;
use App\Http\Controllers\API\InitController;
use App\Http\Requests\API\UpdateOrderRequest;
use App\Http\Resources\API\OrderInfoResource;
use App\Pipelines\Criterias\FilterOrdersPipeline;

class OrderController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Order');
    }

    
    public function index(Request $request)
    {
        $user = getCarrier();

        $this->pipeline->pushPipeline(new FilterOrdersPipeline($request));

        $orders = $this->pipeline->where('carrier_id', $user->id)->get();

        $response = OrderResource::collection($orders);

        return jsonResponse(200, 'done.', $response); 
    }
    
    public function show($id)
    {
        $user = getCarrier();

        $order = $this->pipeline->where([
            'carrier_id' => $user->id,
            'id' => $id
        ])->first();
        
        if (!$order) {
            return jsonResponse(404, 'not found.'); 
        }

        $response = new OrderInfoResource($order);

        return jsonResponse(200, 'done.', $response); 
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $user = getCarrier();

        $order = $this->pipeline->where([
            'carrier_id' => $user->id,
            'id' => $id
        ])->first();
        
        if (!$order) {
            return jsonResponse(404, 'not found.'); 
        }

        if ($request->status == 'rejected') {
            $catItems = $order->catItems();
            foreach ($catItems as $item) {
                $item->product->increment('in_stock', $item->qty);
            }
        }

        $order->update([
            'status' => $request->status,
            'rejection_reason' => $request->rejection_reason,
        ]);

        return jsonResponse(201, 'done.'); 
    }
}
