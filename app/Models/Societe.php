<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Societe extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'adderss',
        'Telephone',
        'user_id'
    ];

    public function announces(){
        return$this->HasMany(Announce::class,'societes');
        
    }
}
