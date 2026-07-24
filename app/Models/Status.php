<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $primaryKey = 'id_status';
    public $timestamps = false; // Matikan timestamps

    protected $fillable = ['nama_status'];

    // Relasi One-to-Many ke User
    public function users()
    {
        return $this->hasMany(User::class, 'id_status', 'id_status');
    }
}