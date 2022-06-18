<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inscription;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use Milon\Barcode\DNS1D;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'specialite' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'secteur' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','confirmed'],      
        ],['email.confirmed' => 'Email de confirmation incompatible','email.unique' => 'Cet email est déjà pris si c\'est votre mail veuillez l\'utiliser pour se connecter ']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   $barecode = time();
        $barename =$barecode.'.png';
        $user=User::create([
            'name' => $data['name'],
            'prenom'=> $data['prenom'],
            'email' => $data['email'],
            'specialite' => $data['specialite'],
            'ville' => $data['ville'],
            'tlf' => $data['gsm'],
            'password' => Hash::make("123"),
            'barecode' => $barecode,
        ]);
        Storage::disk('public')->put($barename,base64_decode(DNS1D::getBarcodePNG(strval($barecode), 'C128A')));
        $msg = [
            'barecode'=> $barename,
        ];
        Mail::to($data['email'])->send(new Inscription($msg));
        return $user;
    }
}
