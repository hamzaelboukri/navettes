<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'telephone',
        'address',
    ];

    // No timestamps by default
    public $timestamps = true;

    // Client belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}