<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function users()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }
}

