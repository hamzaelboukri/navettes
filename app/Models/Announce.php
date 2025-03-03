<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    use HasFactory;

    protected $fillable = [
        'societe_id',
        'date_debut', 
        'date_arriver',
        'heure_debut',
        'heure_arriver',
        'destination',
        'description',
        'status',
        'nb_place'
    ];
    
    public function societe() {
        return $this->belongsTo(Societe::class);
    }
    
    public function reservations() {
        return $this->hasMany(Reservation::class, 'offer_id');
    }
}
