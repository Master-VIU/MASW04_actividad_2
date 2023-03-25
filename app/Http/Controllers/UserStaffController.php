<?php

namespace App\Http\Controllers;

use App\Models\ResultResponse;
use App\Models\UserStaff;
use Illuminate\Http\Request;

class UserStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStaff = UserStaff::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($userStaff);
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserStaff  $userStaff
     * @return \Illuminate\Http\Response
     */
    public function show($userStaffID)
    {
        $resultResponse = new ResultResponse();
        try {
            $userStaff = UserStaff::findOrFail($userStaffID);

            $resultResponse->setData($userStaff);
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
     * @param  \App\Models\UserStaff  $userStaff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userStaffID)
    {
        
    }


    public function put(Request $request, $userStaffID)
    {
 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserStaff  $userStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserStaff $userStaff)
    {
        //
    }
}
