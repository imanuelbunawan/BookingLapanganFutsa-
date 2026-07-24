<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id_role';
    public $timestamps = false; // Matikan timestamps

    protected $fillable = ['nama_role'];

    // Relasi One-to-Many ke User
    public function users()
    {
        return $this->hasMany(User::class, 'id_role', 'id_role');
    }
}