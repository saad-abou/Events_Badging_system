<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class confirmes extends Model
{
    use HasFactory;

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
        'user_id',
        'admin_id'
    ];
}
