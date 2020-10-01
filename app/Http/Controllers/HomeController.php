<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Aws\DynamoDb\DynamoDbClient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'prevent-airlock-user']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        // Test DDB
        $sdk = new DynamoDbClient([
            'region'   => 'ap-southeast-1',
            'version'  => 'latest'
        ]);
        $data = $sdk->listTables();
        dd($data);
    }
}
