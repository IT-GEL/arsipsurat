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
        Schema::create('detail_qr', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment
            $table->string('nosurat'); // Kolom untuk nomor surat
            $table->string('nama'); // Kolom untuk nama
            $table->string('NIK'); // Kolom untuk NIK
            $table->string('jabatan'); // Kolom untuk jabatan
            $table->timestamp('approve_at')->nullable(); // Kolom untuk timestamp persetujuan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_qr');
    }
};
