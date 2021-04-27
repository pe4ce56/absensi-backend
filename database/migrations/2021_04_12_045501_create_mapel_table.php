<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50)->unique();
            $table->timestamps();
        });

        /**
         * Default mapel data
         */
        DB::table('mapel')->insert([
            'nama' => 'Bahasa Indonesia',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('mapel')->insert([
            'nama' => 'Bahasa Inggris',
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
        Schema::dropIfExists('mapel');
    }
}
