<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_mapel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_guru')->unsigned();
            $table->foreign('id_guru')->references('id')->on('guru')->cascadeOnDelete();
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id')->on('mapel')->cascadeOnDelete();
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
        Schema::dropIfExists('guru_mapel');
    }
}
