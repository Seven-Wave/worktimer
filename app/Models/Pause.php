<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pause extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
