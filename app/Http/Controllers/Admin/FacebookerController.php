<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacebookerController extends Controller
{
    /**
     * Facebooker Index
     * @return Factory|View
     */
    public function index()
    {
        $backend = [];

        return view('facebooker.index', compact('backend'));
    }
}
