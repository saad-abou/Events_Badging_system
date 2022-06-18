<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


class reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seance_id',
        'date_entre',
        'date_sortie',
        'confirme',
    ];

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function seance(){
        return $this->belongsTo(seance::class);
    }
}
