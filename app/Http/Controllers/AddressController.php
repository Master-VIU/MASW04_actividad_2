<?php

namespace App\Http\Controllers;

use App\Http\Requests\address\RequestValidateAddress;
use App\Http\Requests\address\RequestValidateAddressOnPut;
use App\Models\Address;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $addresses = Address::select('*')->orderBy('address_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($addresses);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateAddress $request
     * @return JsonResponse
     */
    public function store(RequestValidateAddress $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newAddress = new Address([
                'street' => $request->get('street'),
                'street_number' => $request->get('street_number'),
                'city' => $request->get('city'),
                'postal_code' => $request->get('postal_code')
            ]);

            $newAddress->save();

            $resultResponse->setData($newAddress);
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
     * @param $addressID
     * @return JsonResponse
     */
    public function show($addressID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $address = Address::findOrFail($addressID);

            $resultResponse->setData($address);
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
     * @param Request $request
     * @param $addressID
     * @return JsonResponse
     */
    public function update(RequestValidateAddress $request, $addressID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $address = Address::findOrFail($addressID);
            $address->street = $request->get('street');
            $address->street_number = $request->get('street_number');
            $address->city = $request->get('city');
            $address->postal_code = $request->get('postal_code');
            $address->save();


            $resultResponse->setData($address);
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
     * @param Request $request
     * @param $addressID
     * @return JsonResponse
     */
    public function put(RequestValidateAddressOnPut $request, $addressID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $address = Address::findOrFail($addressID);

            $address->street = $request->get('street', $address->street);
            $address->street_number = $request->get('street_number', $address->street_number);
            $address->city = $request->get('city', $address->city);
            $address->postal_code = $request->get('postal_code', $address->postal_code);
            $address->save();

            $resultResponse->setData($address);
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
     * @param $addressID
     * @return JsonResponse
     */
    public function destroy($addressID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{
            $address = Address::findOrFail($addressID);
            $address->delete();

            $resultResponse->setData("Address with id=".$addressID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
