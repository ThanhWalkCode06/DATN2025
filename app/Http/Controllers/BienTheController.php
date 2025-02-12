<?php

namespace App\Http\Controllers;

use App\Models\BienThe;
use App\Http\Requests\StoreBienTheRequest;
use App\Http\Requests\UpdateBienTheRequest;

class BienTheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.bienthes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.bienthes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBienTheRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BienThe $bienThe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BienThe $bienThe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBienTheRequest $request, BienThe $bienThe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BienThe $bienThe)
    {
        //
    }
}
