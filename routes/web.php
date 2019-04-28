<?php
use App\Animal; //using eloquent, allows us to do database queries in other then SQL.
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    /**
     * Attaches a new column to the pivot table (animal_user), aka. user requested to adopt an animal
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
Route::get('/animal_user_change_status/{animal_id}/attach', function($id) {

    $animal = Animal::find($id);
    
    $user_id = auth()->user()->id;
    $user = User::find($user_id);

    
    $user->animals()->syncWithoutDetaching($animal);


    //$animal->user->sync([$user_id]);


 return Redirect::action('AnimalController@show', array('animal' => $animal))->with('success', 'SUCCESS: Adoption request for animal with ID:' .  $id . ' has been sent.');

});

   /**
     * deAttaches the column from the pivot table (animal_user), aka. user requested to adopt an animal
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
    Route::get('/animal_user_change_status/{animal_id}/{user_id}/detach', function($id, $user_id) {

        $animal = Animal::find($id);

        $user = User::find($user_id);
    
        $user->animals()->detach($animal);
    
    
    return Redirect::action('HomeController@index')->with('success', 'SUCCESS: Adoption request for animal with ID:' .  $id . ' has been cancelled.');

    });

   /**
     * CHANGES the column from the pivot table (animal_user) status to accepted
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
    Route::get('/animal_user_change_status/{animal_id}/{user_id}/Accept', function($animal_id, $user_id) {

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
        

        return Redirect::action('HomeController@index')->with('success', 'SUCCESS: Adoption request with animal ID:' .  $animal_id . ' and user ID:' . $user_id . ' is accepted.');

    });

    
   /**
     * CHANGES the column from the pivot table (animal_user) status to rejected
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
    Route::get('/animal_user_change_status/{animal_id}/{user_id}/Reject', function($animal_id, $user_id) {

        $user = User::find($user_id);

        $user->animals()->updateExistingPivot($animal_id, array('status' => 'Rejected'));

        return Redirect::action('HomeController@index')->with('success', 'SUCCESS: Adoption request with animal ID:' .  $animal_id . ' and user ID:' . $user_id . ' is rejected.');

    });

    ////////////////////
       /**
     * CHANGES the column from the pivot table (animal_user) status to rejected
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
    Route::get('/viewuserdata', function() {

        $users = User::all();

       // $user->animals()->updateExistingPivot($animal_id, array('status' => 'Rejected'));

        return view('user.userdata')->with('users', $users);;

    });

        ////////////////////
       /**
     * CHANGES the column from the pivot table (animal_user) status to rejected
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
    Route::get('/viewanimalsdata', function() {

        $animals = Animal::all();

       // $user->animals()->updateExistingPivot($animal_id, array('status' => 'Rejected'));

        return view('user.animaldata')->with('animals', $animals);;

    });


Route::get('/', 'AnimalController@index'); // just incase anything redricts to '/'
Route::resource('Animal', 'AnimalController');
Route::resource('animal_users', 'animal_usersController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

