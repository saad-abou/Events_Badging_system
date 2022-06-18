<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
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

    public function getSeancesData(Request $request)
    {
        $selecetData= reservation::where('seance_id',$request->id)->with('user')->get();
        return $selecetData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addReservation(Request $request)
    {
        $user = user::where('barecode',$request->barecode)->first();
        $reservation=reservation::create([
            'user_id'=>$user['id'],
            'seance_id' => $request->id,
            'date_entre'=>now()
        ]);
        return $reservation;
    }

    public function addReservationEnd(Request $request)
    {
        $reservation=reservation::where('id',$request->id)->update([
            'date_sortie'=>now()
        ]);
        return $reservation;
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
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(reservation $reservation)
    {
        //
    }
}
