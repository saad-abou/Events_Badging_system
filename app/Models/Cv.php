<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable=[
        'id_theme','profile_pic','title','desc','horaire','sujet'
    ];
}
