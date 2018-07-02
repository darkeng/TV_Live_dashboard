<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Tools\Robot;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smallinfo = json_decode(Robot::GetSmallInfo(), true);

        return view('dashboard.home', ['data' => $smallinfo]);
    }
}
