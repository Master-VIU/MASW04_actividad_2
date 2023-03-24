<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ResultResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($products);
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
            $newProduct = new Product([
                'category_id' => $request->get('category_id'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'properties' => $request->get('properties'),
                'stock' => $request->get('stock')
            ]);

            $newProduct->save();

            $resultResponse->setData($newProduct);
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($productID)
    {
        $resultResponse = new ResultResponse();
        try {
            $product = Product::findOrFail($productID);

            $resultResponse->setData($product);
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productID)
    {
        $resultResponse = new ResultResponse();

        try {

            $product = Product::findOrFail($productID);
            $product->category_id = $request->get('category_id');
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->price = $request->get('price');
            $product->properties = $request->get('properties');
            $product->stock = $request->get('stock');
            $product->save();


            $resultResponse->setData($product);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }


    public function put(Request $request, $productID)
    {
       

        $resultResponse = new ResultResponse();

        try {

            $product = Product::findOrFail($productID);

            $product->category_id = $request->get('category_id', $product->category_id);
            $product->name = $request->get('name', $product->name);
            $product->description = $request->get('description', $product->description);
            $product->price = $request->get('price', $product->price);
            $product->properties = $request->get('properties', $product->properties);
            $product->stock = $request->get('stock', $product->stock);
            $product->save();


            $resultResponse->setData($product);
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($productID)
    {
        $resultResponse = new ResultResponse();
        
        try{

            $product = Product::findOrFail($productID);
            $product->delete();

            $resultResponse->setData($product);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
