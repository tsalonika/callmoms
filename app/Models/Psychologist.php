<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_psychologists';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_users');
    }
}
