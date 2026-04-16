<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $mahasiswaList = DB::table('mahasiswa_table')->pluck('npm')->toArray();
        $matakuliahList = DB::table('mata_kuliah_table')->pluck('kode_matakuliah')->toArray();
    
        $data = [];

        foreach ($mahasiswaList as $npm) {

            
            for ($i = 0; $i < 2; $i++) {
                $data[] = [
                    'npm' => $npm,
                    'kode_matakuliah' => $matakuliahList[array_rand($matakuliahList)],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        DB::table('krs_table')->insert($data);

    }
}
