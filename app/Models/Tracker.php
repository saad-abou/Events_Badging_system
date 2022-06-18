<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable=[
        'id_user','nom','email','date_entree','date_sortie','time'
    ];
}
