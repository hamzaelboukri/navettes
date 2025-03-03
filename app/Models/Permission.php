<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // app/Models/Permission.php
    protected $fillable = [
        'id', 
        'name',
           'timestamp'
    ];
    
    public function roles() {
        return $this->belongsToMany(Role::class);
    }
    
}
