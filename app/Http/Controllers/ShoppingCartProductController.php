<?php

namespace App\Http\Controllers;

use App\Http\Requests\shopping_cart_product\RequestValidateShoppingCartProduct;
use App\Http\Requests\shopping_cart_product\RequestValidateShoppingCartProductOnPut;
use App\Models\ResultResponse;
use App\Models\ShoppingCartProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingCartProductController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = ShoppingCartProduct::select('*');

        if ($request->has('shopping_cart_id')) {
            $query = $query->where('shopping_cart_id', '=', $request->get('shopping_cart_id'));
        }
        if ($request->has('product_id')) {
            $query = $query->where('product_id', '=', $request->get('product_id'));
        }
        if ($request->has('quantity')) {
            $query = $query->where('quantity', '=', $request->get('quantity'));
        }

        if ($request->has('search')) {
            $query = $query->where('shopping_cart_id', '=', $request->get('search'))
                ->orWhere('product_id', '=', $request->get('search'))
                ->orWhere('quantity', '=', $request->get('search'));
        }

        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $cart_products = $query->orderBy('shopping_cart_product_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($cart_products);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateShoppingCartProduct $request
     * @return JsonResponse
     */
    public function store(RequestValidateShoppingCartProduct $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newCartProduct = new ShoppingCartProduct([
                'shopping_cart_id' => $request->get('shopping_cart_id'),
                'product_id' => $request->get('product_id'),
                'quantity' => $request->get('quantity'),
            ]);

            $newCartProduct->save();

            $resultResponse->setData($newCartProduct);
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
     * @param $newCartProductID
     * @return JsonResponse
     */
    public function show($newCartProductID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $cartProduct = ShoppingCartProduct::findOrFail($newCartProductID);

            $resultResponse->setData($cartProduct);
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
     * @param RequestValidateShoppingCartProduct $request
     * @param $newCartProductID
     * @return JsonResponse
     */
    public function update(RequestValidateShoppingCartProduct $request, $newCartProductID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $cartProduct = ShoppingCartProduct::findOrFail($newCartProductID);
            $cartProduct->shopping_cart_id = $request->get('shopping_cart_id');
            $cartProduct->product_id = $request->get('product_id');
            $cartProduct->quantity = $request->get('quantity');
            $cartProduct->save();

            $resultResponse->setData($cartProduct);
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
     * @param RequestValidateShoppingCartProductOnPut $request
     * @param $newCartProductID
     * @return JsonResponse
     */
    public function put(RequestValidateShoppingCartProductOnPut $request, $newCartProductID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $cartProduct = ShoppingCartProduct::findOrFail($newCartProductID);

            $cartProduct->shopping_cart_id = $request->get('shopping_cart_id', $cartProduct->shopping_cart_id);
            $cartProduct->product_id = $request->get('product_id', $cartProduct->product_id);
            $cartProduct->quantity = $request->get('quantity', $cartProduct->quantity);
            $cartProduct->save();


            $resultResponse->setData($cartProduct);
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
     * @param $newCartProductID
     * @return JsonResponse
     */
    public function destroy($newCartProductID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $cartProduct = ShoppingCartProduct::findOrFail($newCartProductID);
            $cartProduct->delete();

            $resultResponse->setData("ShoppingCartProduct with id=".$newCartProductID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
