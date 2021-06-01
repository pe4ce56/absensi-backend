<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapels = [
            // 'Bahasa Indonesia',
            'Bahasa Jepang',
            // 'Bahasa Inggris',
            'Matematika',
            'Penjaskes',
            'TIK',
            'PWPB',
            'PBO',
            'PKK',
            'Sejarah'
        ];

        foreach($mapels as $mapel){
            DB::table('mapel')->insert([
                'nama' => $mapel,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
