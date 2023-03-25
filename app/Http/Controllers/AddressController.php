<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ResultResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($address);
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
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show($addressID)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $addressID)
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


    public function put(Request $request, $addressID)
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
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($addressID)
    {
        $resultResponse = new ResultResponse();

        try{

            $address = Address::findOrFail($addressID);
            $address->delete();

            $resultResponse->setData($address);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
