<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $total_docotr  = User::where('type', '=', 'Doctor')->count('id');
        $total_patient  = User::where('type', '=', 'Patient')->count('id');
        return view('home',compact('total_docotr','total_patient'));
    }

    public function logout(){
        auth()->logout();
        return view('auth.login');
    }
}
