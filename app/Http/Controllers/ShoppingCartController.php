<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidateShoppingCart;
use App\Models\ResultResponse;
use App\Models\ShoppingCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $cars = ShoppingCart::select('*')->orderBy('shopping_cart_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($cars);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateShoppingCart $request
     * @return JsonResponse
     */
    public function store(RequestValidateShoppingCart $request): JsonResponse
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
     * @param $shoppingCartID
     * @return JsonResponse
     */
    public function show($shoppingCartID): JsonResponse
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
     * @param RequestValidateShoppingCart $request
     * @param $shoppingCartID
     * @return JsonResponse
     */
    public function update(RequestValidateShoppingCart $request, $shoppingCartID): JsonResponse
    {
        $validated = $request->validated();
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
     * @param $shoppingCartID
     * @return JsonResponse
     */
    public function destroy($shoppingCartID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $cart = ShoppingCart::findOrFail($shoppingCartID);
            $cart->delete();

            $resultResponse->setData("Cart with id=".$shoppingCartID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
