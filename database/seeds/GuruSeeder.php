<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $teacherTypes = ['normal', 'honorer'];
        $nipsOrTeacherCode = [];
        $genders = ['male', 'female'];

        for($i = 0; $i<700; $i++){
            $TType = $teacherTypes[array_rand($teacherTypes)];
            $numerifyString = '';

            switch($TType){
                case 'normal':{
                    $numerifyString = '##################';
                    break;
                }
                case 'honorer':{
                    $numerifyString = 'G-#########';
                    break;
                }
            }

            $nipsOrTeacherCode []= $faker->unique()->numerify($numerifyString);

            $gender = $genders[array_rand($genders)];
            $userId = DB::table('user')->insertGetId([
                'username' => $nipsOrTeacherCode[$i],
                'password' => bcrypt('guru'),
                'foto_profil' => 'default.jpg',
                'role' => 'guru',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $birthYear = $faker->year();

            DB::table('guru')->insert([
                'data_of' => $userId,
                'NIP' => $nipsOrTeacherCode[$i],
                'nama' => $faker->name($gender),
                'jk' => $gender === 'male' ? 'l' : 'p',
                'whatsapp' => preg_replace('/[() ]/', '', $faker->phoneNumber),
                'alamat' => $faker->address,
                'tanggal_lahir' => $faker->date('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
