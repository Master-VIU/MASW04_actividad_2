<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ResultResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($categories);
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
            $newCategory = new Category([
                'name_category' => $request->get('name_category')
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($categoryID)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryID)
    {
        $resultResponse = new ResultResponse();

        try {

            $category = Category::findOrFail($categoryID);
            $category->name_category = $request->get('name_category');
            $category->save();


            $resultResponse->setData($category);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }


    public function put(Request $request, $categoryID)
    {


        $resultResponse = new ResultResponse();

        try {

            $category = Category::findOrFail($categoryID);

            $category->name_category = $request->get('name_category', $category->name_category);
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryID)
    {
        $resultResponse = new ResultResponse();

        try {

            $category = Category::findOrFail($categoryID);
            $category->delete();

            $resultResponse->setData($categoryID);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}