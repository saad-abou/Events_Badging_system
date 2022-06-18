<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackerController extends Controller
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
    public function create(Request $request)
    {
        // $all = Tracker::where('id_user',Auth()->user()->id)->get();

        // if(empty($all)){
        //     $new=Tracker::create([
        //         'id_user'=>Auth()->user()->id,
        //         'nom'=>Auth()->user()->name,
        //         'email'=>Auth()->user()->email,
        //         'date_entree'=>now()
        //     ]);
        //     return $new;
        // }else{
        //     return $all['id'];
        // }

        $new=Tracker::create([
            'id_user'=>Auth()->user()->id,
            'nom'=>Auth()->user()->name,
            'email'=>Auth()->user()->email,
            'date_entree'=>now()
        ]);
        return $new;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Tracker::find($id);
        $edit->date_sortie=now();
        $edit->time=(strtotime(now())- strtotime($edit->date_entree))/60;
        $edit->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
