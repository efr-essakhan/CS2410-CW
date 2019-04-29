<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use App\User;
use App\Animal; //using eloquent, allows us to do database queries in other then SQL.


class Animal_usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('home')->with('animals', $user->animals);
    }

    
    /**
     * Attaches a new column to the pivot table (animal_user), aka. user requested to adopt an animal
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
    public function attach($id)
    {
        $animal = Animal::find($id);
    
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
    
        
        $user->animals()->syncWithoutDetaching($animal);

         return Redirect::action('AnimalController@show', array('animal' => $animal))->with('success', 'SUCCESS: Adoption request for animal with ID:' .  $id . ' has been sent.');
    }

       /**
     * detaches the column from the pivot table (animal_user), aka. user requested to adopt an animal
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */

    public function detach($id, $user_id)
    {
        $animal = Animal::find($id);

        $user = User::find($user_id);
    
        $user->animals()->detach($animal);
    
    
       return Redirect::action('HomeController@index')->with('success', 'SUCCESS: Adoption request for animal with ID:' .  $id . ' has been cancelled.');
    }

       /**
     * CHANGES the column from the pivot table (animal_user) status to accepted
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */

    public function setAcceptToStatusColumn($animal_id, $user_id)
    {
        Animal::where('id', $animal_id)->update(array('available' => 'No'));
        

        //Firstly rejecting any other requests for this animal by all users (setting status column of pivot table to 'rejected') 
        $users = User::all();
        foreach($users as $user)
        {
            $user_animals = $user->animals;

            if((count($user_animals)>0)){
                foreach($user_animals as $user_animal)
                {
                    if($user_animal->id == $animal_id)
                    {
                        $user->animals()->updateExistingPivot($user_animal->id, array('status' => 'Rejected'));
                    }
                }
            }
          
        }

        //Then turning the specific column value on the user that gets this animal to Accepted
        $user = User::find($user_id);
        $user->animals()->updateExistingPivot($animal_id, array('status' => 'Accepted'));

        //Setting the prod
        

        return Redirect::action('HomeController@index')->with('success', 'SUCCESS: Adoption request with animal ID:' .  $animal_id . ' and user ID:' . $user_id . ' is Accepted.');
    }

       /**
     * CHANGES the column from the pivot table (animal_user) status to rejected
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */

    public function setRejectToStatusColumn($animal_id, $user_id){

        $user = User::find($user_id);

        $user->animals()->updateExistingPivot($animal_id, array('status' => 'Rejected'));

        return Redirect::action('HomeController@index')->with('success', 'SUCCESS: Adoption request with animal ID:' .  $animal_id . ' and user ID:' . $user_id . ' is rejected.');

    }

           /**
     * Shows the userdata table
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */

    public function viewUserData(){

      
        $users = User::all();

        return view('user.userdata')->with('users', $users);;

    }

           /**
     * CHANGES the column from the pivot table (animal_user) status to rejected
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */

    public function viewAnimalData(){

        $animals = Animal::all();
 
         return view('user.animaldata')->with('animals', $animals);;

    }
}
