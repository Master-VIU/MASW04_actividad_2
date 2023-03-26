<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidateUserOnUpdate;
use App\Http\Requests\user\RequestValidateUser;
use App\Http\Requests\user\RequestValidateUserOnPut;
use App\Models\ResultResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $users = User::select('*')->orderBy('user_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($users);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateUser $request
     * @return JsonResponse
     */
    public function store(RequestValidateUser $request): JsonResponse
    {
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

    /**
     * Display the specified resource.
     *
     * @param $userID
     * @return JsonResponse
     */
    public function show($userID): JsonResponse
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
     * @param RequestValidateUser $request
     * @param $userID
     * @return JsonResponse
     */
    public function update(RequestValidateUser $request, $userID): JsonResponse
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param RequestValidateUserOnPut $request
     * @param $userID
     * @return JsonResponse
     */
    public function put(RequestValidateUserOnPut $request, $userID): JsonResponse
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
     * @param $userID
     * @return JsonResponse
     */
    public function destroy($userID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $user = User::findOrFail($userID);
            $user->delete();

            $resultResponse->setData("User with id=".$userID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
