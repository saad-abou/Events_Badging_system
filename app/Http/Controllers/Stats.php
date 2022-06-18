<?php

namespace App\Http\Controllers;

use App\Events\badgeEvent;
use App\Models\Tracker;
use App\Models\User;
use App\Models\seance;
use App\Models\reservation;
use App\Models\reservconfirme;
use App\Mail\Inscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\confirmation;
use App\Models\confirmes;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use Milon\Barcode\DNS1D;
use Response;

class Stats extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=User::with('admin')->get();
        return $all;
    }

    public function getUsersPrint()
    {
        $all=User::where('admin_id' , Auth::user()->id)->get();
        return $all;
    }

    public function getUsersAttents()
    {
        $all=confirmes::where('admin_id' , Auth::user()->id)->get();
        return $all;
    }

    public function getallusersconfirme()
    {
        $all=User::where('confirme',1)->get();
        return $all;
    }

    public function visited()
    {
        $all = Tracker::all()->unique('nom');
        return $all->count();
    }

    public function getUser(){
        $user = User::find(Auth::user()->id);
        return $user;
    }

    public function confirmUser(Request $request){
        $user = User::where('id', $request->editedItem['id'])->update([  
                'confirme' => '1',
                'admin_id' => Auth::user()->id,
        ]);
        $userconfirme=confirmes::create([
            'name' => $request->editedItem['name'],
            'confirme' => '1',
            'prenom'=> $request->editedItem['prenom'],
            'email' => $request->editedItem['email'],
            'admin_id' => Auth::user()->id,
            'user_id' => $request->editedItem['id'],
            'badge' => isset($request->editedItem['badge']) ? $request->editedItem['badge'] : null,
            'barecode' => $request->editedItem['barecode'],
        ]);
        $msg = [
            'name' => $request->editedItem['name'],
            'prenom'=> $request->editedItem['prenom'],
            'email' => $request->editedItem['email'],
            'admin_id' => Auth::user()->id,
        ];
        broadcast(new badgeEvent($msg));
        return $user;
    }

    public function addBadge(Request $request){
        $user = User::where('id', $request->id)
            ->increment('badge',1);
        $confirme = confirmes::where('user_id', $request->id)->first();
        $FirstAdminId = isset($confirme->admin_id) ? $confirme->admin_id : null;
        isset($confirme->id) ? $confirme->delete() : null;
        $msg = [
            'name' => $request->name,
            'prenom'=> $request->prenom,
            'email' => $request->email,
            'first_admin' => $FirstAdminId,
            'admin_id' => 0,
        ];
        broadcast(new badgeEvent($msg));
    }

    public function addBadgeAdmin(Request $request){
        if (isset($request->item['user_id'])){
            $user = User::where('id', $request->item['user_id'])
            ->increment('badge',1);
            $confirme = confirmes::where('id', $request->item['id'])
            ->delete();
        }
        else{
            $user = User::where('id', $request->item['id'])
            ->increment('badge',1);
        }
        
    }

    public function addNewComptes(Request $request){
        $data = $request->input('comptes');
        foreach ($data as $compte) {
            $user=User::create([
                'name' =>  isset($compte['nom']) ? $compte['nom'] : null,
                'prenom' =>  isset($compte['prenom']) ? $compte['prenom'] : null,
                'statut' =>  isset($compte['statut']) ? $compte['statut'] : null,
                'ville' =>  isset($compte['ville']) ? $compte['ville'] : null,
                'tlf' =>  isset($compte['gsm']) ? $compte['gsm'] : null,
                'email' =>  isset($compte['email']) ? $compte['email'] : null,
            ]);
        }
    }


    public function addNewCompte(Request $request){
        $user=User::create([
            'name' => $request->user['nom'],
            'prenom'=> $request->user['prenom'],
            'email' => $request->user['email'],
            'tlf' => $request->user['gsm'],
            'password' => Hash::make("123"),
        ]);
        $barecode = time().$user->id;
        $barename =$barecode.'.png';
        $user->update(['barecode' => $barecode,]);
        Storage::disk('public')->put($barename,base64_decode(DNS1D::getBarcodePNG(strval($barecode), 'C128A')));
        $msg = [
            'barecode'=> $barename,
        ];
        Mail::to($request->user['email'],)->send(new Inscription($msg));
        return $user;
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
