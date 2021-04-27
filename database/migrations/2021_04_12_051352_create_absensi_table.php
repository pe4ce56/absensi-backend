<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
            $table->integer('id_jadwal')->unsigned();
            $table->foreign('id_jadwal')->references('id')->on('jadwal')->cascadeOnDelete();
            $table->time('waktu', 0)->comment('Waktu absensi siswa (Jam)');
            $table->string('lokasi')->comment('Lokasi koordinat google maps contoh: 3.900736,23.56036');
            $table->string('keterangan')->nullable()->comment('Keterangan jika siswa melakukan izin');
            $table->enum('status', ['s', 'i', 'a'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
