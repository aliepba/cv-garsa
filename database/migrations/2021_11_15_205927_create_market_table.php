<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('title');
            $table->string('no_telp');
            $table->text('alamat');
            $table->timestamps();
        });

        DB::table('markets')->insert(
            array(
                'nama_toko' => 'CV Garsa Sejahtera',
                'title' => 'Perusahaan Garam Pelabuhan Kapal & Garsal',
                'no_telp' => '0838-2295-5833',
                'alamat' => 'Kp. Cijalong Ds. Linggasari Kec. Darangdan - Purwakarta'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('markets');
    }
}
