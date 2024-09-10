<?php

namespace App\Http\Controllers;

use App\Models\GA;
use App\Http\Requests\StoreGARequest;
use App\Http\Requests\UpdateGARequest;

class GAController extends Controller
{
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
     * @param  \App\Http\Requests\StoreGARequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGARequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function show(GA $ga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function edit(GA $ga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGARequest  $request
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGARequest $request, GA $ga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function destroy(GA $ga)
    {
        //
    }
}
