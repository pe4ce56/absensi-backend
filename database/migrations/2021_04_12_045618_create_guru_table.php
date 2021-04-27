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
            $table->string('NIP', 18)->unique()->comment('Untuk guru yang tidak memiliki NIP maka NIP diganti dengan kode. contoh : G-392315124');
            $table->string('nama', 50);
            $table->enum('jk', ['l', 'p']);
            $table->string('whatsapp', 15)->unique();
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->timestamps();
        });


        /**
         * Default NIP Number
         */
        $NIP = '111112222233333444';
        /**
         * Default KodeGuru
         */
        $KodeGuru = 'G-124124155';

        /**
         * Default akun guru tetap
         */
        $userId = DB::table('user')->insertGetId([
            'username' => $NIP,
            'password' => bcrypt('guru'),
            'role' => 'guru',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('guru')->insert([
            'data_of' => $userId,
            'NIP' => $NIP,
            'nama' => 'Sulastri',
            'jk' => 'p',
            'whatsapp' => '+6285755799604',
            'alamat' => 'Malang',
            'tanggal_lahir' => Carbon::now()->subYears(25)->format('Y-m-d'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        /**
         * Default akun guru tidak tetap
         */
        $userId = DB::table('user')->insertGetId([
            'username' => $KodeGuru,
            'password' => bcrypt('gurutidaktetap'),
            'role' => 'guru',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('guru')->insert([
            'data_of' => $userId,
            'NIP' => $KodeGuru,
            'nama' => 'Safitri',
            'jk' => 'p',
            'whatsapp' => '+628815392482',
            'alamat' => 'Janti',
            'tanggal_lahir' => Carbon::now()->subYears(18)->format('Y-m-d'),
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
