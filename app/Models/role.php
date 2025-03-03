<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'name', 
        'created_at',
         'updated_at',
          'timestamp'
    ];
    
    public function users() {
        return $this->hasMany(User::class);
    }
    

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }
}
