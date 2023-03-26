<?php

namespace App\Http\Controllers;

use App\Http\Requests\repairment\RequestValidateRepairment;
use App\Http\Requests\repairment\RequestValidateRepairmentOnPut;
use App\Models\Repairment;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RepairmentController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Repairment::select('*');

        if ($request->has('description')) {
            $query = $query->where('description', 'ilike', '%'.$request->get('description').'%');
        }
        if ($request->has('price')) {
            $query = $query->where('price', '=', $request->get('price'));
        }
        if ($request->has('staff_id')) {
            $query = $query->where('staff_id', '=', $request->get('staff_id'));
        }
        if ($request->has('client_id')) {
            $query = $query->where('client_id', '=', $request->get('client_id'));
        }

        if ($request->has('search')) {
            $query = $query->where('description', 'ilike', '%'.$request->get('search').'%');
        }

        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $repairments = $query->orderBy('repairment_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($repairments);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateRepairment $request
     * @return JsonResponse
     */
    public function store(RequestValidateRepairment $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newRepairment = new Repairment([
                'description' => $request->get('description'),
                'request_date' => $request->get('request_date'),
                'repairment_date' => $request->get('repairment_date'),
                'price' => $request->get('price'),
                'staff_id' => $request->get('staff_id'),
                'client_id' => $request->get('client_id'),
            ]);

            $newRepairment->save();

            $resultResponse->setData($newRepairment);
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
     * @param $repairmentID
     * @return JsonResponse
     */
    public function show($repairmentID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $repairment = Repairment::findOrFail($repairmentID);

            $resultResponse->setData($repairment);
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
     * @param RequestValidateRepairment $request
     * @param $repairmentID
     * @return JsonResponse
     */
    public function update(RequestValidateRepairment $request, $repairmentID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $repairment = Repairment::findOrFail($repairmentID);
            $repairment->description = $request->get('description');
            $repairment->request_date = $request->get('request_date');
            $repairment->repairment_date = $request->get('repairment_date');
            $repairment->price = $request->get('price');
            $repairment->staff_id = $request->get('staff_id');
            $repairment->client_id = $request->get('client_id');
            $repairment->save();


            $resultResponse->setData($repairment);
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
     * @param RequestValidateRepairmentOnPut $request
     * @param $repairmentID
     * @return JsonResponse
     */
    public function put(RequestValidateRepairmentOnPut $request, $repairmentID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $repairment = Repairment::findOrFail($repairmentID);

            $repairment->description = $request->get('description', $repairment->description);
            $repairment->request_date = $request->get('request_date', $repairment->request_date);
            $repairment->repairment_date = $request->get('repairment_date', $repairment->repairment_date);
            $repairment->price = $request->get('price', $repairment->price);
            $repairment->staff_id = $request->get('staff_id', $repairment->staff_id);
            $repairment->client_id = $request->get('client_id', $repairment->client_id);

            $repairment->save();


            $resultResponse->setData($repairment);
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
     * @param $repairmentID
     * @return JsonResponse
     */
    public function destroy($repairmentID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $repairment = Repairment::findOrFail($repairmentID);
            $repairment->delete();

            $resultResponse->setData("Repairment with id=".$repairmentID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
