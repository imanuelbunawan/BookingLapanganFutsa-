<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'id_announcement';

    protected $fillable = [
        'id_user_admin',
        'judul',
        'isi_pengumuman',
        'is_active'
    ];

    // Relasi ke User (Admin pembuat pengumuman)
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user_admin', 'id_user');
    }
}
