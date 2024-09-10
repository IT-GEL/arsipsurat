<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_t_s', function (Blueprint $table) {
            $table->id();
            $table->string('perihal');
            $table->string('noSurat')->unique();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('divisi');
            $table->text('keterangan');
            $table->date('tglSurat');
            $table->string('ettd');
            $table->string('ttd');
            $table->string('namaTtd');
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
        Schema::dropIfExists('its');
    }
};
