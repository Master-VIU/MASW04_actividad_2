<?php

namespace App\Http\Controllers;

use App\Http\Requests\product_image\RequestValidateProductImage;
use App\Http\Requests\product_image\RequestValidateProductImageOnPut;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductImageController extends Controller
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

        $productImage = ProductImage::select('*')->orderBy('image_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($productImage);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateProductImage $request
     * @return JsonResponse
     */
    public function store(RequestValidateProductImage $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newProductImage = new ProductImage([
                'product_id' => $request->get('product_id'),
                'image_path' => $request->get('image_path'),
            ]);

            $newProductImage->save();

            $resultResponse->setData($newProductImage);
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
     * @param $productImageID
     * @return JsonResponse
     */
    public function show($productImageID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $productImage = ProductImage::findOrFail($productImageID);

            $resultResponse->setData($productImage);
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
     * @param RequestValidateProductImage $request
     * @param $productImageID
     * @return JsonResponse
     */
    public function update(RequestValidateProductImage $request, $productImageID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $productImage = ProductImage::findOrFail($productImageID);
            $productImage->product_id = $request->get('product_id');
            $productImage->image_path = $request->get('image_path');
            $productImage->save();


            $resultResponse->setData($productImage);
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
     * @param RequestValidateProductImageOnPut $request
     * @param $productImageID
     * @return JsonResponse
     */
    public function put(RequestValidateProductImageOnPut $request, $productImageID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $productImage = ProductImage::findOrFail($productImageID);

            $productImage->product_id = $request->get('product_id', $productImage->product_id);
            $productImage->image_path = $request->get('image_path', $productImage->image_path);
            $productImage->save();


            $resultResponse->setData($productImage);
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
     * @param $productImageID
     * @return JsonResponse
     */
    public function destroy($productImageID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $productImage = ProductImage::findOrFail($productImageID);
            $productImage->delete();

            $resultResponse->setData("ProductImage with id=".$productImageID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
