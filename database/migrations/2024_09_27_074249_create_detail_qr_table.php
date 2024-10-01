<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailQrTable extends Migration
{
    public function up()
    {
        Schema::create('detail_qr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nosurat', 255)->nullable();
            $table->string('nama', 255)->nullable();
            $table->string('NIK', 255)->nullable();
            $table->string('jabatan', 255)->nullable();
            $table->text('qr')->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->timestamps(); // This includes both created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_qr');
    }
}
