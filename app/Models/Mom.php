<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mom extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_moms';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_users');
    }
}
