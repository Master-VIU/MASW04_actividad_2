<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\RequestValidateProduct;
use App\Http\Requests\product\RequestValidateProductOnPut;
use App\Models\Product;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::select('*');

        if ($request->has('category_id')) {
            $query = $query->where('category_id', 'ilike', '%'.$request->get('category_id').'%');
        }
        if ($request->has('name')) {
            $query = $query->where('name', 'ilike', '%'.$request->get('name').'%');
        }
        if ($request->has('description')) {
            $query = $query->where('description', 'ilike', '%'.$request->get('description').'%');
        }
        if ($request->has('price')) {
            $query = $query->where('price', 'ilike', '%'.$request->get('price').'%');
        }
        if ($request->has('properties')) {
            $query = $query->where('properties', 'ilike', '%'.$request->get('properties').'%');
        }
        if ($request->has('stock')) {
            $query = $query->where('stock', 'ilike', '%'.$request->get('stock').'%');
        }
        if ($request->has('search')) {
            $query = $query->where('name', 'ilike', '%'.$request->get('search').'%')
                        ->orWhere('description', 'ilike', '%'.$request->get('search').'%')
                        ->orWhere('properties', 'ilike', '%'.$request->get('search').'%');
        }

        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $products = $query->orderBy('product_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($products);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateProduct $request
     * @return JsonResponse
     */
    public function store(RequestValidateProduct $request): JsonResponse
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
     * @param $productID
     * @return JsonResponse
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
     * @param RequestValidateProduct $request
     * @param $productID
     * @return JsonResponse
     */
    public function update(RequestValidateProduct $request, $productID): JsonResponse
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

    /**
     * Update the specified resource in storage.
     *
     * @param RequestValidateProductOnPut $request
     * @param $productID
     * @return JsonResponse
     */
    public function put(RequestValidateProductOnPut $request, $productID): JsonResponse
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
     * @param $productID
     * @return JsonResponse
     */
    public function destroy($productID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $product = Product::findOrFail($productID);
            $product->delete();

            $resultResponse->setData("Product with id=".$productID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
