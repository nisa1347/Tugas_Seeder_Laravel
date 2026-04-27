<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah_table';
    protected $primaryKey = 'kode_matakuliah';
    public $incrementing = false;

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks'
    ];

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'nidn', 'nidn');
    }
}
