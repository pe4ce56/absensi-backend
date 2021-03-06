<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MapelSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(SiswaSeeder::class);
    }
}
