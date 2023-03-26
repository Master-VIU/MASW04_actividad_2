<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\RequestValidateUser;
use App\Http\Requests\user_client\RequestValidateUserClient;
use App\Http\Requests\user_client\RequestValidateUserClientOnPut;
use App\Models\ResultResponse;
use App\Models\UserClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = UserClient::select('*');

        if ($request->has('shopping_cart_id')) {
            $query = $query->where('shopping_cart_id', '=', $request->get('shopping_cart_id'));
        }
        if ($request->has('user_id')) {
            $query = $query->where('user_id', '=', $request->get('user_id'));
        }
        if ($request->has('search')) {
            $query = $query->where('shopping_cart_id', '=', $request->get('search'))
                ->orWhere('user_id', '=', $request->get('search'));
        }

        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $offset = $request->has('offset') ? $request->get('offset') : 0;

        $users = $query->orderBy('user_client_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($users);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateUserClient $request
     * @return JsonResponse
     */
    public function store(RequestValidateUserClient $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newClient = new UserClient([
                'shopping_cart_id' => $request->get('shopping_cart_id'),
                'user_id' => $request->get('user_id')
            ]);

            $newClient->save();

            $resultResponse->setData($newClient);
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
     * @param $userClientID
     * @return JsonResponse
     */
    public function show($userClientID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $client = UserClient::findOrFail($userClientID);

            $resultResponse->setData($client);
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
     * @param RequestValidateUserClient $request
     * @param $userClientID
     * @return JsonResponse
     */
    public function update(RequestValidateUserClient $request, $userClientID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $client = UserClient::findOrFail($userClientID);
            $client->user_id = $request->get('user_id');
            $client->shopping_cart_id = $request->get('shopping_cart_id');
            $client->save();

            $resultResponse->setData($client);
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
     * @param RequestValidateUserClientOnPut $request
     * @param $userClientID
     * @return JsonResponse
     */
    public function put(RequestValidateUserClientOnPut $request, $userClientID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $client = UserClient::findOrFail($userClientID);

            $client->user_id = $request->get('user_id', $client->user_id);
            $client->shopping_cart_id = $request->get('shopping_cart_id', $client->shopping_cart_id);
            $client->save();


            $resultResponse->setData($client);
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
     * @param $userClientID
     * @return JsonResponse
     */
    public function destroy($userClientID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $client = UserClient::findOrFail($userClientID);
            $client->delete();

            $resultResponse->setData("Client with id=".$userClientID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
