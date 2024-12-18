<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'key_id',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];

    // Define relationship with User model if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}