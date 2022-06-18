<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'statut',
        'name',
        'prenom',
        'barecode',
        'payproof',
        'etudeproof',
        'statut',
        'specialite',
        'secteur',
        'departement',
        'adresse',
        'confirme',
        'pays',
        'ville',
        'tlf',
        'gsm',
        'email',
        'password',
        'admin_id'
    ];


    public function allReservation(){
        return $this->hasMany(reservation::class);
    }

    public function admin(){
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
