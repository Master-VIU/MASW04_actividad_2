<?php

namespace App\Http\Controllers;

use App\Http\Requests\person\RequestValidatePerson;
use App\Http\Requests\person\RequestValidatePersonOnPut;
use App\Models\Person;
use App\Models\ResultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PersonController extends Controller
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

        $persons = Person::select('*')->orderBy('person_id', 'asc')->offset($offset * $limit)->limit($limit)->get();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($persons);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param RequestValidatePerson $request
     * @return JsonResponse
     */
    public function store(RequestValidatePerson $request): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {
            $newPerson = new Person([
                'dni' => $request->get('dni'),
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'email' => $request->get('email'),
                'telephone' => $request->get('telephone'),
                'user_id' => $request->get('user_id'),
            ]);

            $newPerson->save();

            $resultResponse->setData($newPerson);
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
     * @param $personID
     * @return JsonResponse
     */
    public function show($personID): JsonResponse
    {
        $resultResponse = new ResultResponse();
        try {
            $person = Person::findOrFail($personID);

            $resultResponse->setData($person);
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
     * @param RequestValidatePerson $request
     * @param $personID
     * @return JsonResponse
     */
    public function update(RequestValidatePerson $request, $personID): JsonResponse
    {

        $resultResponse = new ResultResponse();

        try {

            $person = Person::findOrFail($personID);
            $person->dni = $request->get('dni');
            $person->name = $request->get('name');
            $person->surname = $request->get('surname');
            $person->email = $request->get('email');
            $person->telephone = $request->get('telephone');
            $person->user_id = $request->get('user_id');

            $person->save();


            $resultResponse->setData($person);
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
     * @param RequestValidatePersonOnPut $request
     * @param $personID
     * @return JsonResponse
     */
    public function put(RequestValidatePersonOnPut $request, $personID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try {

            $person = Person::findOrFail($personID);

            $person->dni = $request->get('dni', $person->dni);
            $person->name = $request->get('name', $person->name);
            $person->surname = $request->get('surname', $person->surname);
            $person->email = $request->get('email', $person->email);
            $person->telephone = $request->get('telephone', $person->telephone);
            $person->user_id = $request->get('user_id', $person->user_id);
            $person->save();


            $resultResponse->setData($person);
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
     * @param $personID
     * @return JsonResponse
     */
    public function destroy($personID): JsonResponse
    {
        $resultResponse = new ResultResponse();

        try{

            $person = Person::findOrFail($personID);
            $person->delete();

            $resultResponse->setData("Person with id=".$personID." has been removed.");
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
