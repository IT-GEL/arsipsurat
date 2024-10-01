<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItsTable extends Migration
{
    public function up()
    {
        Schema::create('i_t_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('perihal', 255);
            $table->string('noSurat', 255);
            $table->text('nama');
            $table->string('jabatan', 255);
            $table->string('divisi', 255);
            $table->text('keterangan');
            $table->date('tglSurat');
            $table->string('ttd', 255);
            $table->string('namaTtd', 255);
            $table->string('ettd', 255)->nullable();
            $table->timestamps(); // This includes both created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('i_t_s');
    }
}
