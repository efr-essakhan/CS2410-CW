<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Data for Normal users
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        //Data for Admin users

        return view('user.managerequest')->with('animals', $user->animals);
    }

    
}
