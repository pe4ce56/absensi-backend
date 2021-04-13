<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('data_of')->unsigned();
            $table->foreign('data_of')->references('id')->on('user')->cascadeOnDelete();
            $table->string('NIP', 18)->unique();
            $table->string('nama', 100);
            $table->enum('jk', ['l', 'p']);
            $table->string('whatsapp', 15)->unique();
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->timestamps();
        });

        $userId = DB::table('user')->insertGetId([
            'username' => 'guru',
            'password' => bcrypt('guru'),
            'foto_profil' => 'default.jpg',
            'role' => 'guru',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('guru')->insert([
            'data_of' => $userId,
            'NIP' => '111112222233333444',
            'nama' => 'Sulastri',
            'jk' => 'p',
            'whatsapp' => '+6285755799604',
            'alamat' => 'Malang',
            'tanggal_lahir' => Carbon::now()->format('Y-m-d'),
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
        Schema::dropIfExists('guru');
    }
}
