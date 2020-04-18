<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Contracts\Support\Renderable|void
     */
    public function index()
    {
        // Airlock / Sanctum
        if (!empty(auth()->id()) && auth()->id() === 2) {
            auth()->logout();
            return abort(401);
        }
        return view('home');
    }
}
