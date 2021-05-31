<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $classList = [
            'X RPL 1',
            'X RPL 2',
            'X TKJ 1',
            'X TKJ 2',
            'X MM 1',
            'X MM 2',
            'X MM 3',
            'X AV 1',
            'X AV 2',
            'X MT 1',
            'X MT 2',
            'X EI 1',
            'X EI 2',
            'X AN 1',
            'X AN 2',
            'X BC 1',
            'X BC 2',
            'XI RPL 1',
            'XI RPL 2',
            'XI TKJ 1',
            'XI TKJ 2',
            'XI MM 1',
            'XI MM 2',
            'XI MM 3',
            'XI AV 1',
            'XI AV 2',
            'XI MT 1',
            'XI MT 2',
            'XI EI 1',
            'XI EI 2',
            'XI AN 1',
            'XI AN 2',
            'XI BC 1',
            'XI BC 2',
            // 'XII RPL 1',
            'XII RPL 2',
            'XII TKJ 1',
            'XII TKJ 2',
            'XII MM 1',
            'XII MM 2',
            'XII MM 3',
            'XII AV 1',
            'XII AV 2',
            'XII MT 1',
            'XII MT 2',
            'XII EI 1',
            'XII EI 2',
            'XII AN 1',
            'XII AN 2',
            'XII BC 1',
            'XII BC 2',
        ];

        foreach($classList as $class){
            DB::table('kelas')->insert([
                'nama' => $class,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
