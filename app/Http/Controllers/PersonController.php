<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidatePerson;
use App\Models\Person;
use App\Models\ResultResponse;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::all();

        $resultResponse = new ResultResponse();

        $resultResponse->setData($persons);
        $resultResponse->setStatus(ResultResponse::SUCCESS);

        return response()->json($resultResponse);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestValidatePerson $request)
    {
        $request->validated();

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
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show($personID)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $personID)
    {
        
        $resultResponse = new ResultResponse();

        try {

            $person = Person::findOrFail($personID);
            $person->dni = $request->get('dni');
            $person->name = $request->get('name');
            $person->surname = $request->get('surname');
            $person->email = $request->get('email');
            $person->telephone = $request->get('telephone');
  
            $person->save();


            $resultResponse->setData($person);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        } catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }

        return response()->json($resultResponse);
    }


    public function put(Request $request, $personID)
    {
       

        $resultResponse = new ResultResponse();

        try {

            $person = Person::findOrFail($personID);

            $person->dni = $request->get('dni', $person->dni);
            $person->name = $request->get('name', $person->name);
            $person->surname = $request->get('surname', $person->surname);
            $person->email = $request->get('email', $person->email);
            $person->telephone = $request->get('telephone', $person->dni);
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
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($personID)
    {
        $resultResponse = new ResultResponse();

        try{

            $person = Person::findOrFail($personID);
            $person->delete();

            $resultResponse->setData($person);
            $resultResponse->setStatus(ResultResponse::SUCCESS);
        }catch (\Exception $e) {
            $resultResponse->setStatus(ResultResponse::NOT_FOUND);
            $resultResponse->setData($e->getMessage());
        }
        return response()->json($resultResponse);
    }
}
