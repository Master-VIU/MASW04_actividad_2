<?php

namespace App\Http\Controllers;

use App\Http\Requests\rating\RequestValidateRating;
use App\Http\Requests\rating\RequestValidateRatingOnPut;
use App\Models\Rating;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
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

        $ratings = Rating::select('*')->orderBy('rating_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($ratings);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateRating $request
     * @return JsonResponse
     */
    public function store(RequestValidateRating $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newrating = new Rating([
                'rate' => $request->get('rate'),
                'opinion' => $request->get('opinion'),
                'date' => $request->get('date'),
                'user_client_id' => $request->get('user_client_id'),
                'product_id' => $request->get('product_id')
            ]);

            $newrating->save();

            $resultResponse->setData($newrating);
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
     * @param $ratingID
     * @return JsonResponse
     */
    public function show($ratingID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $rating = Rating::findOrFail($ratingID);

            $resultResponse->setData($rating);
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
     * @param RequestValidateRating $request
     * @param $ratingID
     * @return JsonResponse
     */
    public function update(RequestValidateRating $request, $ratingID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $rating = Rating::findOrFail($ratingID);
            $rating->rate = $request->get('rate');
            $rating->opinion = $request->get('opinion');
            $rating->date = $request->get('date');
            $rating->user_client_id = $request->get('user_client_id');
            $rating->product_id = $request->get('product_id');
            $rating->save();


            $resultResponse->setData($rating);
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
     * @param RequestValidateRatingOnPut $request
     * @param $ratingID
     * @return JsonResponse
     */
    public function put(RequestValidateRatingOnPut $request, $ratingID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $rating = Rating::findOrFail($ratingID);

            $rating->rate = $request->get('rate', $rating->rate);
            $rating->opinion = $request->get('opinion', $rating->opinion);
            $rating->date = $request->get('date', $rating->date);
            $rating->user_client_id = $request->get('user_client_id', $rating->user_client_id);
            $rating->product_id = $request->get('product_id', $rating->product_id);
            $rating->save();


            $resultResponse->setData($rating);
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
     * @param $ratingID
     * @return JsonResponse
     */
    public function destroy($ratingID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $rating = Rating::findOrFail($ratingID);
            $rating->delete();

            $resultResponse->setData("Rating with id=".$ratingID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
