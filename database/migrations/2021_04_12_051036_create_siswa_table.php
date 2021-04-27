<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('data_of')->unsigned();
            $table->foreign('data_of')->references('id')->on('user')->cascadeOnDelete();
            $table->string('NISN', 10)->unique();
            $table->string('nama', 50);
            $table->enum('jk', ['l', 'p']);
            $table->string('whatsapp', 15)->unique();
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('foto_siswa')->default('siswa-default.jpg')->nullable();
            $table->integer('id_kelas')->unsigned();
            $table->foreign('id_kelas')->references('id')->on('kelas')->cascadeOnDelete();
            $table->timestamps();
        });

        /**
         * Default data Siswa
         */
        $NISN = '0011223344';
        $userId = DB::table('user')->insertGetId([
            'username' => $NISN,
            'password' => bcrypt('siswa'),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('siswa')->insert([
            'data_of' => $userId,
            'NISN' => $NISN,
            'nama' => 'Burhan Udin Samson',
            'jk' => 'l',
            'whatsapp' => '+6267988277683',
            'alamat' => 'singosari',
            'tanggal_lahir' => Carbon::now()->subYears(10)->format('Y-m-d'),
            'id_kelas' => 1,
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
        Schema::dropIfExists('siswa');
    }
}
