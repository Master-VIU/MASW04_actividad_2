<?php

namespace App\Http\Controllers;

use App\Models\ResultResponse;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = ShoppingCart::all();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($cars);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resultResponse = new ResultResponse();

        try {
            $newCart = new ShoppingCart([
                'total_cost' => $request->get('total_cost')
            ]);

            $newCart->save();

            $resultResponse->setData($newCart);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::ERROR);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show($shoppingCartID)
    {
        $resultResponse = new ResultResponse();
        try {
            $cart = ShoppingCart::findOrFail($shoppingCartID);

            $resultResponse->setData($cart);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);            
            $resultResponse->setData($e->getMessage());

        }
        return response()->json($resultResponse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shoppingCartID)
    {
        $resultResponse = new ResultResponse();

        try {

            $cart = ShoppingCart::findOrFail($shoppingCartID);
            $cart->total_cost = $request->get('total_cost');
            $cart->save();


            $resultResponse->setData($cart);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy($shoppingCartID)
    {
        $resultResponse = new ResultResponse();

        try{

            $cart = ShoppingCart::findOrFail($shoppingCartID);
            $cart->delete();

            $resultResponse->setData($cart);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
