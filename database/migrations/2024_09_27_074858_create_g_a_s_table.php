<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasTable extends Migration
{
    public function up()
    {
        Schema::create('g_a_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('noSurat', 255);
            $table->string('nama', 255);
            $table->string('pt', 255);
            $table->string('vendor', 255);
            $table->string('tempatTglLahir', 255);
            $table->text('keterangan');
            $table->date('tglSurat');
            $table->string('ttd', 255);
            $table->string('namaTtd', 255);
            $table->timestamps(); // This includes both created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('g_a_s');
    }
}
