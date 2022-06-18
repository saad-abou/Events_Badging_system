<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seance extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'jour',
        'heure',
        'totalPlace',
        'reserve', 
        'track',
        'sujet',
        'd_seance'
    ];

    public function reservations(){
        return $this->hasMany(reservation::class);
    }

    
}
