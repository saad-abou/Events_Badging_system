<?php

namespace App\Http\Controllers;

use App\Mail\Inscription;
use App\Mail\notificationProof;
use App\Models\APP_User;
use App\Models\Tracker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use Milon\Barcode\DNS1D;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trackers=Tracker::all();
        return $trackers;
    }

    public function find(Request $request)
    {
        $email=$request->email;
        $user=APP_User::where('email',$email)->get();
        if(count($user)!=0){
            session_start();
            $_SESSION['user']=$user[0]->email;
            $tracker=Tracker::create([
                'email'=>$email,
                'status' => $user[0]->labo,
            ]);
            return $_SESSION['user'];
        }else{
            return 0;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUnique()
    {
        $trackers=Tracker::all();
        $trackers=$trackers->flatten()->unique('email');

        return count($trackers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barecode = time();
        $barename =$barecode.'.png';
        $user=User::create([
            // 'name' => str_replace(' ','_',$request->name),
            'name' => $request->name,
            'prenom' => $request->prenom,
            'statut' => $request->statut,
            'secteur' => $request->secteur,
            'pays' => $request->pays,
            'tlf' => $request->gsm,
            'email' => $request->email,
            'barecode' => $barecode,
        ]);
        Storage::disk('public')->put($barename,base64_decode(DNS1D::getBarcodePNG(strval($barecode), 'C128A')));
        $msg = [
            'barecode'=> $barename,
        ];

        Mail::to($request->email)->send(new Inscription($msg));
    }

    public function resendconfirm(Request $request)
    {

        Mail::to($request->email)->send(new Inscription());
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function getBareCode(){
        $user = User::where('id', 1270)->first();
        $barename =time().'.png';
        Storage::disk('public')->put($barename,base64_decode(DNS1D::getBarcodePNG(strval($user->barecode), 'C39+')));
        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(strval($user->barecode), 'C39+') . '" alt="barcode"   />';
        $msg = [
            'barecode'=> $barename,
        ];
        Mail::to('saad.sen.niko@gmail.com')->send(new Inscription($msg));
        return view('userbare',['user'=>$user]);
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
