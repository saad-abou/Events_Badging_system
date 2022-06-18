<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use App\Models\seance;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Seances = Seance::with('reservations')->get();
       return $Seances;
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
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function show(seance $seance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function edit(seance $seance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, seance $seance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function destroy(seance $seance)
    {
        //
    }
}
