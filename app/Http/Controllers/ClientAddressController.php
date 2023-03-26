<?php

namespace App\Http\Controllers;

use App\Http\Requests\client_address\RequestValidateClientAddressOnPut;
use App\Http\Requests\client_address\RequestValidateClientAddress;
use App\Models\ClientAddress;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientAddressController extends Controller
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

        $client_address = ClientAddress::select('*')->orderBy('client_address_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($client_address);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateClientAddress $request
     * @return JsonResponse
     */
    public function store(RequestValidateClientAddress $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newClientAddress = new ClientAddress([
                'client_id' => $request->get('client_id'),
                'address_id' => $request->get('address_id'),
            ]);

            $newClientAddress->save();

            $resultResponse->setData($newClientAddress);
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
     * @param $clientAddressID
     * @return JsonResponse
     */
    public function show($clientAddressID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $clientAddress = ClientAddress::findOrFail($clientAddressID);

            $resultResponse->setData($clientAddress);
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
     * @param RequestValidateClientAddress $request
     * @param $clientAddressID
     * @return JsonResponse
     */
    public function update(RequestValidateClientAddress $request, $clientAddressID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $clientAddress = ClientAddress::findOrFail($clientAddressID);
            $clientAddress->client_id = $request->get('client_id');
            $clientAddress->address_id = $request->get('address_id');
            $clientAddress->save();


            $resultResponse->setData($clientAddress);
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
     * @param RequestValidateClientAddressOnPut $request
     * @param $clientAddressID
     * @return JsonResponse
     */
    public function put(RequestValidateClientAddressOnPut $request, $clientAddressID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $clientAddress = ClientAddress::findOrFail($clientAddressID);

            $clientAddress->client_id = $request->get('client_id', $clientAddress->client_id);
            $clientAddress->address_id = $request->get('address_id', $clientAddress->address_id);
            $clientAddress->save();


            $resultResponse->setData($clientAddress);
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
     * @param $clientAddressID
     * @return JsonResponse
     */
    public function destroy($clientAddressID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $clientAddress = ClientAddress::findOrFail($clientAddressID);
            $clientAddress->delete();

            $resultResponse->setData("ClientAddress with id=".$clientAddressID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
