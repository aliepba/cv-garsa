<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->string('no_pegawai');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('total_absen');
            $table->integer('total_korosok')->nullable();
            $table->integer('total_pk20')->nullable();
            $table->integer('total_pk40')->nullable();
            $table->integer('total_pkk20')->nullable();
            $table->integer('total_pkk40')->nullable();
            $table->integer('total_gaji');
            $table->string('approve')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('gaji');
    }
}
