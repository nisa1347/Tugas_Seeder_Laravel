<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class Dosen_tableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('Id_ID');
        $NamaDosen = [
                    'Dr. Ahmad Fauzi, S.T., M.T.',
                    'Dr. Siti Rahmawati, S.Kom., M.Kom.',
                    'Ir. Budi Santoso, M.Eng.',
                    'Dr. Rina Kartika, S.E., M.M.',
                    'Dr. Andi Pratama, S.Kom., M.Cs.',
                    'Dr. Dewi Lestari, S.Pd., M.Pd.',
                    'Ir. Hendra Wijaya, M.T.',
                    'Dr. Maya Sari, S.Kom., M.T.I.',
                    'Dr. Rizky Saputra, S.T., M.T.',
                    'Dr. Nurul Hidayah, S.Kom., M.Kom.'
        ];

        $data = [];

        for($i=0; $i<10; $i++){
            $data[] = [
                    'nidn'=> 'D' . str_pad($i+1, 3, '0', STR_PAD_LEFT),
                    'nama'=> $NamaDosen[$i],
                    'created_at'=> now(),
                    'updated_at'=> now(),
            ];
        }
        DB::table('dosen_table')->insert($data);
    }
}
