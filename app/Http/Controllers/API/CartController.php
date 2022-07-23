<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CartRequest;
use App\Http\Resources\API\CartResource;

class CartController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Cart');
    }

    public function show($id)
    {
        $cart = $this->pipeline->where(['user_id' => getUser()->id, 'id' => $id])->first();

        if (!$cart) {
            return jsonResponse(404, 'not found!');
        }

        $items = $cart->items;
        $data = CartResource::collection($items);

        return jsonResponse(200, 'done.', $data);
    }

    public function store(CartRequest $request)
    {
        DB::beginTransaction();
        try {
            
            $cart = $this->pipeline->create(['user_id' => getUser()->id]);
            $this->pipeline->setModel('Product');

            foreach($request->items as $item) {
                $product = $this->pipeline->find($item['product_id']);
                $item['price'] = $product->price;
                $item['unit'] = $product->unit;
                
                $data[] = $item;
            }
            $cart->items()->createMany($data);
            
            DB::commit();
        } catch (\Exception $ex) {

            DB::rollback();
            dd($ex->getMessage());
        }
        
        return jsonResponse(201);   
    }


    public function update(CartRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $cart = $this->pipeline->where(['id' => $id, 'user_id' => getUser()->id])->first();
            if (!$cart) {
                return jsonResponse(404, 'not found!');
            }

            $this->pipeline->setModel('Product');

            $cart->items()->delete();

            $data = [];
            foreach($request->items as $item) {
                $product = $this->pipeline->find($item['product_id']);
                $item['price'] = $product->price;
                $item['unit'] = $product->unit;
                
                $data[] = $item;
            }
            $cart->items()->createMany($data);

            DB::commit();
        } catch (\Exception $ex) {

            DB::rollback();
            dd($ex->getMessage());
        }
        
        return jsonResponse(201);   
    }
}
