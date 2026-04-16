<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kodeMatkul = [
            'MK001','MK002','MK003','MK004','MK005',
            'MK006','MK007','MK008','MK009','MK010'
        ];

        $nidnList = [
            'D001','D002','D003','D004','D005',
            'D006','D007','D008','D009','D010'
        ];

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $kelasList = ['A', 'B'];

        for ($i = 0; $i < 10; $i++) {
        $data[] = [
                'id' => $i + 1, // hapus kalau auto increment
                'kode_matakuliah' => $kodeMatkul[$i],
                'nidn' => $nidnList[$i],
                'kelas' => $kelasList[$i % 2], // A, B, A, B...
                'hari' => $hariList[$i % 5],   // muter hari
                'jam' => now()->setTime(8 + $i, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('jadwal_table')->insert($data);
    }
}
