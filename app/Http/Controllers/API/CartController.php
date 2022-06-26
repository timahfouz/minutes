<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CartRequest;

class CartController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Cart');
    }

    public function __invoke(CartRequest $request)
    {
        DB::beginTransaction();
        try {
            
            $cart = $this->pipeline->create(['user_id' => getUser()->id]);
            foreach($request->items as $item) {
                $cart->items()->create($item);
            }
            
            DB::commit();
        } catch (\Exception $ex) {

            DB::rollback();
            dd($ex->getMessage());
        }
        
        return jsonResponse(201);   
    }
}
