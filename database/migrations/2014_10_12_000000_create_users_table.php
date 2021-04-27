<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique()->comment('Username untuk Guru menggunakan NIP/Kode guru, untuk Siswa menggunakan NISN');
            $table->string('password');
            $table->string('foto_profil')->default('default.jpg')->nullable();
            $table->enum('role', ['admin', 'operator', 'guru', 'siswa']);
            $table->rememberToken();
            $table->timestamps();
        });

        /*
        * For Default Admin Account
        */
        DB::table('user')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        /**
         * Default Operator account
         */
        DB::table('user')->insert([
            'username' => 'operator',
            'password' => bcrypt('operator'),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
