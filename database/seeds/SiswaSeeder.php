<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $genders = ['male', 'female'];
        // $usernames = [];
        $nisns = [];

        for($i = 0; $i<100; $i++){
            // $usernames []= $faker->unique()->username;
            $nisns []= $faker->unique()->numerify('##########');

            $gender = $genders[array_rand($genders)];
            $userId = DB::table('user')->insertGetId([
                'username' => $nisns[$i],
                'password' => bcrypt('siswa'),
                'foto_profil' => 'default.jpg',
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $birthYear = $faker->year();

            DB::table('siswa')->insert([
                'data_of' => $userId,
                'NISN' => $nisns[$i],
                'nama' => $faker->name($gender),
                'jk' => $gender === 'male' ? 'l' : 'p',
                'whatsapp' => preg_replace('/[() ]/', '', $faker->phoneNumber),
                'alamat' => $faker->address,
                'tanggal_lahir' => $faker->date('Y-m-d'),
                'foto_siswa' => 'siswa.jpg',
                'id_kelas' => rand(1,50),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
