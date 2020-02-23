<?php

namespace App\Http\Controllers;

use App\LarOption;
use App\Repositories\LarOptionRepositoryInterface;
use Illuminate\Http\Request;

class LarOptionController extends Controller
{
    /**
     * @var LarOptionRepositoryInterface
     */
    protected $repository;

    /**
     * LarOptionController constructor.
     * @param LarOptionRepositoryInterface $repository
     */
    public function __construct(LarOptionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LarOption  $larOption
     * @return \Illuminate\Http\Response
     */
    public function show(LarOption $larOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LarOption  $larOption
     * @return \Illuminate\Http\Response
     */
    public function edit(LarOption $larOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LarOption  $larOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LarOption $larOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LarOption  $larOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(LarOption $larOption)
    {
        //
    }
}
