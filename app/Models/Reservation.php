<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
         'user_id',
          'offer_id', 
          'status',
           'timestamp'
            
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function announce() {
        return $this->belongsTo(Announce::class, 'offer_id');
    }
}
