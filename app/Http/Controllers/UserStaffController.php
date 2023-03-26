<?php

namespace App\Http\Controllers;

use App\Http\Requests\user_staff\RequestValidateUserStaff;
use App\Http\Requests\user_staff\RequestValidateUserStaffOnPut;
use App\Models\ResultResponse;
use App\Models\UserStaff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserStaffController extends Controller
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

        $staff = UserStaff::select('*')->orderBy('user_staff_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($staff);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateUserStaff $request
     * @return JsonResponse
     */
    public function store(RequestValidateUserStaff $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newStaff = new UserStaff([
                'role' => $request->get('role'),
                'user_id' => $request->get('user_id')
            ]);

            $newStaff->save();

            $resultResponse->setData($newStaff);
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
     * @param $userStaffID
     * @return JsonResponse
     */
    public function show($userStaffID): JsonResponse
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
     * @param RequestValidateUserStaff $request
     * @param $userStaffID
     * @return JsonResponse
     */
    public function update(RequestValidateUserStaff $request, $userStaffID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $staff = UserStaff::findOrFail($userStaffID);
            $staff->role = $request->get('role');
            $staff->user_id = $request->get('user_id');
            $staff->save();


            $resultResponse->setData($staff);
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
     * @param RequestValidateUserStaffOnPut $request
     * @param $userStaffID
     * @return JsonResponse
     */
    public function put(RequestValidateUserStaffOnPut $request, $userStaffID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $user = UserStaff::findOrFail($userStaffID);
            $user->role = $request->get('role', $user->role);
            $user->user_id = $request->get('user_id', $user->user_id);
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
     * @param $userStaffID
     * @return JsonResponse
     */
    public function destroy($userStaffID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $user = UserStaff::findOrFail($userStaffID);
            $user->delete();

            $resultResponse->setData("Staff with id=".$userStaffID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
