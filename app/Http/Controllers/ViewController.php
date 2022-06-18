<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');

    }

    public function landing()
    {
        if(Auth()->user()){
            return view('welcome');
        }else{
            return view('auth.login');
        }
    }

    public function usersPreinscrit()
    {
        return view('usersPreinscrit');
    }

    public function admin()
    {
        return view('admin.layout');
    }

    public function question()
    {
        return view('admin.question');
    }

    public function tracker()
    {
        return view('admin.tracker');
    }

    public function link()
    {
        return view('admin.lien');
    }

    public function moderateur()
    {
        return view('moderateur');
    }

    public function share()
    {
        return view('share');
    }

    public function stats()
    {
        return view('stats');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        //
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
        //
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
