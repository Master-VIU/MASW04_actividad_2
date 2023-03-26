<?php

namespace App\Http\Controllers;

use App\Http\Requests\order\RequestValidateOrder;
use App\Http\Requests\order\RequestValidateOrderOnPut;
use App\Models\Order;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $orders = Order::select('*')->orderBy('order_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($orders);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateOrder $request
     * @return JsonResponse
     */
    public function store(RequestValidateOrder $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newOrder = new Order([
                'price' => $request->get('price'),
                'order_date' => $request->get('order_date'),
                'shipping_date' => $request->get('shipping_date'),
                'location' => $request->get('location'),
                'card_id' => $request->get('card_id'),
                'address_id' => $request->get('address_id'),
                'client_id' => $request->get('client_id'),
                'shopping_cart_id' => $request->get('shopping_cart_id'),
            ]);

            $newOrder->save();

            $resultResponse->setData($newOrder);
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
     * @param $orderID
     * @return JsonResponse
     */
    public function show($orderID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $order = Order::findOrFail($orderID);

            $resultResponse->setData($order);
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
     * @param RequestValidateOrder $request
     * @param $orderID
     * @return JsonResponse
     */
    public function update(RequestValidateOrder $request, $orderID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $order = Order::findOrFail($orderID);
            $order->price = $request->get('price');
            $order->order_date = $request->get('order_date');
            $order->shipping_date = $request->get('shipping_date');
            $order->location = $request->get('location');
            $order->card_id = $request->get('card_id');
            $order->address_id = $request->get('address_id');
            $order->client_id = $request->get('client_id');
            $order->shopping_cart_id = $request->get('shopping_cart_id');
            $order->save();


            $resultResponse->setData($order);
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
     * @param RequestValidateOrderOnPut $request
     * @param $orderID
     * @return JsonResponse
     */
    public function put(RequestValidateOrderOnPut $request, $orderID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $order = Order::findOrFail($orderID);

            $order->price = $request->get('price', $order->price);
            $order->order_date = $request->get('order_date', $order->order_date);
            $order->shipping_date = $request->get('shipping_date', $order->shipping_date);
            $order->location = $request->get('location', $order->location);
            $order->card_id = $request->get('card_id', $order->card_id);
            $order->address_id = $request->get('address_id', $order->address_id);
            $order->client_id = $request->get('client_id', $order->client_id);
            $order->shopping_cart_id = $request->get('shopping_cart_id', $order->shopping_cart_id);
            $order->save();


            $resultResponse->setData($order);
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
     * @param $orderID
     * @return JsonResponse
     */
    public function destroy($orderID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $order = Order::findOrFail($orderID);
            $order->delete();

            $resultResponse->setData("Order with id=".$orderID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
