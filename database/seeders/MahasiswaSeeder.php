<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $NamaMahasiswa = [
            'Andi Saputra',
            'Budi Santoso',
            'Citra Lestari',
            'Dewi Anggraini',
            'Eko Prasetyo',
            'Fajar Nugroho',
            'Gita Permata',
            'Hendra Wijaya',
            'Intan Sari',
            'Joko Susilo'
        ];

        $data = [];

        $nidnList = DB::table('dosen_table')->pluck('nidn')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                    'npm' => str_pad($i+1, 10, '0', STR_PAD_LEFT),
                    'nidn' => $nidnList[$i % count($nidnList)],
                    'nama' => $NamaMahasiswa[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
            ];
        }
        DB::table('mahasiswa_table')->insert($data);
    }
}
