<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal; //using eloquent, allows us to do database queries in other then SQL.

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals =  Animal::all(); //fetches all of the data in the Animal table.
        return view('animals.index')->with('animals', $animals); // http://astonanimal.k/Animal will link to this page
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'animaltype' => 'required',
            'radios'  => 'required',
            'dob-day' => 'required',
            'dob-month' => 'required',
            'dob-year' => 'required'

        ]);
           
        //using tinker to store the animal data into the DB
        $animal = new Animal;
        $animal->nameTitle = $request->input('title');
        $animal->description = $request->input('body');
        $animal->animaltype = $request->input('animaltype');
        $animal->available = $request->input('radios');

        //Entering DOB into DB by concatinating drop down values.
        $dob = $request->input('dob-year') . '-' . $request->input('dob-month') . '-' . $request->input('dob-day');
        $animal->dob = $dob;

        $animal->save();

        return redirect('/Animal')->with('success', 'Animal Profile Created'); //Will redirect and show success message. Success message will be shown due to the session(success) in messages.blade.php  
    

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // http://astonanimal.k/Animal/{id} will link to this page
        $animal = Animal::find($id);
        return view('animals.show')->with('animal', $animal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $animal = Animal::find($id);
        return view('animals.edit')->with('animal', $animal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
              //validation
              $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'animaltype' => 'required',
                'radios'  => 'required',
                'dob-day' => 'required',
                'dob-month' => 'required',
                'dob-year' => 'required'
    
            ]);
        
            //Find animal data in DB and alter.
            $animal = Animal::find($id);
            $animal->nameTitle = $request->input('title');
            $animal->description = $request->input('body');
            $animal->animaltype = $request->input('animaltype');
            $animal->available = $request->input('radios');
            //Entering DOB into DB by concatinating drop down values.
            $dob = $request->input('dob-year') . '-' . $request->input('dob-month') . '-' . $request->input('dob-day');
            $animal->dob = $dob;

            $animal->save();

            return redirect('/Animal')->with('success', 'Animal Profile Updated'); //Will redirect and show success message. Success message will be shown due to the session(success) in messages.blade.php  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
