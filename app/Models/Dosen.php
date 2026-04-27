<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen_table';
    protected $fillable = [
        'nidn',
        'nama'
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nidn', 'nidn');
    }
}
