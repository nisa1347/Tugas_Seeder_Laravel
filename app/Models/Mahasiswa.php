<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa_table';
    protected $primaryKey = 'npm';
    public $incrementing = false;

    protected $fillable = [
        'npm',
        'nidn',
        'nama'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }
}
