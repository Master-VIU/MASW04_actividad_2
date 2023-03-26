<?php

namespace App\Http\Controllers;

use App\Http\Requests\card\RequestValidateCard;
use App\Http\Requests\card\RequestValidateCardOnPut;
use App\Http\Requests\RequestValidateUserOnUpdate;
use App\Models\Card;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
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

        $cards = Card::select('*')->orderBy('card_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($cards);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidateCard $request
     * @return JsonResponse
     */
    public function store(RequestValidateCard $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newCard = new Card([
                'card_number' => $request->get('card_number'),
                'type' => $request->get('type'),
                'cvv' => $request->get('cvv'),
                'expiration_date' => $request->get('expiration_date'),
                'user_client_id' => $request->get('user_client_id'),
            ]);

            $newCard->save();

            $resultResponse->setData($newCard);
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
     * @param $cardID
     * @return JsonResponse
     */
    public function show($cardID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $card = Card::findOrFail($cardID);

            $resultResponse->setData($card);
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
     * @param RequestValidateCard $request
     * @param $cardID
     * @return JsonResponse
     */
    public function update(RequestValidateCard $request, $cardID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $card = Card::findOrFail($cardID);
            $card->card_number = $request->get('card_number');
            $card->type = $request->get('type');
            $card->cvv = $request->get('cvv');
            $card->expiration_date = $request->get('expiration_date');
            $card->user_client_id = $request->get('user_client_id');
            $card->save();


            $resultResponse->setData($card);
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
     * @param RequestValidateCardOnPut $request
     * @param $cardID
     * @return JsonResponse
     */
    public function put(RequestValidateCardOnPut $request, $cardID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $card =  Card::findOrFail($cardID);

            $card->card_number = $request->get('card_number', $card->card_number);
            $card->type = $request->get('type', $card->type);
            $card->cvv = $request->get('cvv', $card->cvv);
            $card->expiration_date = $request->get('expiration_date', $card->expiration_date);
            $card->user_client_id = $request->get('user_client_id', $card->user_client_id);

            $card->save();

            $resultResponse->setData($card);
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
     * @param $cardID
     * @return JsonResponse
     */
    public function destroy($cardID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $card = Card::findOrFail($cardID);
            $card->delete();

            $resultResponse->setData("Card with id=".$cardID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }
        catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }

}
