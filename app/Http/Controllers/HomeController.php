<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Carbon\Carbon as time;
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
        // Haetaan päivä Carbonin kautta ja viedään home näkymään
        $date = time::now();
        $today = $date->toRfc850String();
        $day = substr($today, 0, strrpos($today, ","));
        // Näytetään kuinka monta postausta käyttäjällä on
        $user_id = auth()->user()->id;
        $userPostsCount = User::find($user_id)->posts()->count();
        return view('home')->with(['day' => $day, 'userPostsCount' => $userPostsCount]);
    }
}
