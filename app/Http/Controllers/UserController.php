<?php

namespace App\Http\Controllers;

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
    public function index(): \Illuminate\Http\JsonResponse
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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validation = $request->validate([
            'name' => 'required',
            'password' => 'required|min:5',
        ]);
        return response()->json($validation);
        $resultResponse = new ResultResponse();

        try
        {
            $newUser = new User([
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password'))
            ]);

            $newUser->save();

            $resultResponse->setData($newUser);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e)
        {
            $resultResponse->setStatus(ResultResponse::ERROR);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $resultResponse = new ResultResponse();

        try
        {
            $user = User::findOrFail($id);

            $resultResponse->setData($user);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e)
        {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $this->validateUser($request);
        $resultResponse = new ResultResponse();

        try
        {
            $user = User::findOrFail($id);

            $user->username = $request->get('username');
            $user->password = Hash::make($request->get('password'));

            $user->save();

            $resultResponse->setData($user);
            $resultResponse->setStatus(ResultResponse::SUCCESS);

        } catch (\Exception $e)
        {
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
    public function destroy(User $user)
    {
        //
    }

    public function validateUser(Request $request): array
    {
        return $request->validate([
            'name' => 'required',
            'password' => 'required|min:5',
        ]);
    }
}
