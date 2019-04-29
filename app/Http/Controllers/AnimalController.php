<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal; //using eloquent, allows us to do database queries in other then SQL.
use App\User;
use Illuminate\Support\Facades\Storage;
class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = '';
        //filter
        if(request()->has('gender')){
            $animals= Animal::where('available', 'Yes')
            ->where('gender', request('gender'))->paginate(5)->appends('gender', request('gender'));

            if(request('gender') == 1){
                $filter = 'Male';
            }
            else{
                $filter = 'Female';}
            
        }elseif(request()->has('animaltype'))
        {
            $animals= Animal::where('available', 'Yes')
            ->where('animaltype', request('animaltype'))->paginate(5)->appends('animaltype', request('animaltype'));
            $filter = request('animaltype');
        }
        else {
            $animals= Animal::where('available', 'Yes')->paginate(5);
            
        }

        
     
        return view('animals.index')->with('animals', $animals)->with('filter', $filter); // http://astonanimal.k/Animal will link to this page
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
            'title' => 'required|max:30',
            'body' => 'required|max:9999',
            'animaltype' => 'required',
            'radios'  => 'required',
            'dob-day' => 'required',
            'dob-month' => 'required',
            'dob-year' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'second_image' => 'image|nullable|max:1999'

        ]);

        //handle file upload cover_image
        if($request->hasFile('cover_image')){
            //get file name with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename . '_' .time(). '.' . $extension; //unique filename

            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $animal = new Animal;
        $animal->cover_image = $fileNameToStore;

         //handle file upload secondary image
         if($request->hasFile('second_image')){
            //get file name with extension
            $filenameWithExt = $request->file('second_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('second_image')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename . '_' .time(). '.' . $extension; //unique filename

            //upload image
            $path = $request->file('second_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }
           
        //using tinker to store the animal data into the DB
        
        $animal->nameTitle = $request->input('title');
        $animal->description = $request->input('body');
        $animal->animaltype = $request->input('animaltype');
        $animal->gender = $request->input('radios');
        $animal->second_image = $fileNameToStore;

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
                'title' => 'required|max:30',
             'body' => 'required|max:9999',
                'animaltype' => 'required',
                'dob-day' => 'required',
                'dob-month' => 'required',
                'radios'  => 'required',
                'dob-year' => 'required',
                'dob-year' => 'required',
                'cover_image' => 'image|nullable|max:1999',
                'second_image' => 'image|nullable|max:1999'
    
            ]);

            $animal = Animal::find($id);
              //handle file upload
        if($request->hasFile('cover_image')){
            //get file name with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename . '_' .time(). '.' . $extension; //unique filename

            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

            $animal->cover_image = $fileNameToStore;
         

        }
           //if upload a new image
        //    if($request->hasFile('cover_image')){
        //    
        // }
       
           
        if($request->hasFile('second_image')){
            //get file name with extension
            $filenameWithExt = $request->file('second_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('second_image')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename . '_' .time(). '.' . $extension; //unique filename

            //upload image
            $path = $request->file('second_image')->storeAs('public/cover_images', $fileNameToStore);

            $animal->second_image = $fileNameToStore;

        }
        // if($request->hasFile('second_image')){
        //     $animal->second_image = $fileNameToStore;
        // }
        
            //Find animal data in DB and alter.
            
            $animal->nameTitle = $request->input('title');
            $animal->description = $request->input('body');
            $animal->animaltype = $request->input('animaltype');
            $animal->gender = $request->input('radios');
         

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
        $animal = Animal::find($id);

        //Delete animal picture from file
        if($animal->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'. $animal->cover_image);
        }
        if($animal->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'. $animal->second_image);
        }
        // delete the record from the animal table.
        $animal->delete();
        return redirect('/Animal')->with('success', 'Animal Profile Deleted');
    }
}
