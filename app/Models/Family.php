<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_families';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_users');
    }
}
