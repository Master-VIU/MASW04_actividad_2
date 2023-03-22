<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidateUser;
use App\Models\ResultResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($users);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RequestValidateUser $request)
    {
        $request->validated();

        $resultResponse = new ResultResponse();

        try {
            $newUser = new User([
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password'))
            ]);

            $newUser->save();

            $resultResponse->setData($newUser);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::ERROR);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }


    public function show($userID)
    {

        $resultResponse = new ResultResponse();
        try {
            $user = User::findOrFail($userID);

            $resultResponse->setData($user);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(RequestValidateUser $request, $userID)
    {
        $request->validated();

        $resultResponse = new ResultResponse();

        try {

            $user = User::findOrFail($userID);
            $user->username = $request->get('username');
            $user->password = Hash::make($request->get('password'));
            $user->save();


            $resultResponse->setData($user);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }




    public function put(Request $request, $userID)
    {
       

        $resultResponse = new ResultResponse();

        try {

            $user = User::findOrFail($userID);

            $user->username = $request->get('username', $user->username);
            $user->password = Hash::make($request->get('password', $user->password));
            $user->save();


            $resultResponse->setData($user);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($userID)
    {
        $resultResponse = new ResultResponse();

        try{

            $user = User::findOrFail($userID);
            $user->delete();

            $resultResponse->setData($user);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

    public function validateUser(RequestValidateUser $request)
    {
        $request->validated();
    }
}