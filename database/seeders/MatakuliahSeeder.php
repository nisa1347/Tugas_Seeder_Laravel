<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $namaMatkul = [
                    'Algoritma dan Pemrograman',
                    'Struktur Data',
                    'Basis Data',
                    'Jaringan Komputer',
                    'Sistem Operasi',
                    'Pemrograman Web',
                    'Rekayasa Perangkat Lunak',
                    'Kecerdasan Buatan',
                    'Data Mining',
                    'Keamanan Informasi'
        ];

        $sks = [2, 3];

        $data = [];

        for ($i = 0; $i < 10; $i++) {
        $data[] = [
                'kode_matakuliah' => 'MK' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'nama_matakuliah' => $namaMatkul[$i],
                'sks' => $sks[$i % count($sks)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('mata_kuliah_table')->insert($data);
    }
}
