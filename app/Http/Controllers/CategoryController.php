<?php

namespace App\Http\Controllers;

use App\Http\Requests\category\RequestValidateCategory;
use App\Http\Requests\category\RequestValidateCategoryOnPut;
use App\Models\Category;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Category::select('*');

        if ($request->has('name_category')) {
            $query = $query->where('name_category', 'ilike', '%'.$request->get('name_category').'%');
        }
        if ($request->has('parent_category_id')) {
            $query = $query->where('parent_category_id', 'like', '%'.$request->get('parent_category_id').'%');
        }
        if ($request->has('search')) {
            $query = $query->where('name_category', 'ilike', '%'.$request->get('search').'%');
        }

        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $categories = $query->orderBy('category_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($categories);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateCategory $request
     * @return JsonResponse
     */
    public function store(RequestValidateCategory $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newCategory = new Category([
                'name_category' => $request->get('name_category'),
                'parent_category_id' => $request->get('parent_category_id')
            ]);

            $newCategory->save();

            $resultResponse->setData($newCategory);
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
     * @param $categoryID
     * @return JsonResponse
     */
    public function show($categoryID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $category = Category::findOrFail($categoryID);

            $resultResponse->setData($category);
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
     * @param RequestValidateCategory $request
     * @param $categoryID
     * @return JsonResponse
     */
    public function update(RequestValidateCategory $request, $categoryID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $category = Category::findOrFail($categoryID);
            $category->name_category = $request->get('name_category');
            $category->name_category = $request->get('parent_category_id');
            $category->save();


            $resultResponse->setData($category);
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
     * @param RequestValidateCategoryOnPut $request
     * @param $categoryID
     * @return JsonResponse
     */
    public function put(RequestValidateCategoryOnPut $request, $categoryID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $category = Category::findOrFail($categoryID);

            $category->name_category = $request->get('name_category', $category->name_category);
            $category->parent_category_id = $request->get('parent_category_id', $category->parent_category_id);
            $category->save();


            $resultResponse->setData($category);
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
     * @param $categoryID
     * @return JsonResponse
     */
    public function destroy($categoryID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $category = Category::findOrFail($categoryID);
            $category->delete();

            $resultResponse->setData("Category with id=".$categoryID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
