<?php

namespace App\Http\Controllers;

use App\Utils;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Utils::ResolveStuff();
        return view('backend.home.dashboard');
    }

    public function charts()
    {
        dd('Statistical charts will be shown here');
        return view('backend.home.charts');
    }

    public function reports()
    {
        dd('Data reports will be shown here');
        return view('backend.home.reports');
    }

}
