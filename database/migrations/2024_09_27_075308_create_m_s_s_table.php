<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSSTable extends Migration
{
    public function up()
    {
        Schema::create('m_s_s', function (Blueprint $table) {
            $table->id(); // Automatically adds an unsigned BIGINT PRIMARY KEY id.
            $table->string('noSurat')->nullable();
            $table->string('prefix');
            $table->integer('idPerihal');
            $table->string('perihal')->nullable();
            $table->string('perihalBA')->nullable();
            $table->string('pttujuan')->nullable();
            $table->string('ptkunjungan')->nullable();
            $table->string('commodity')->nullable();
            $table->string('source')->nullable();
            $table->text('alamat')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('country')->nullable();
            $table->string('spec')->nullable();
            $table->date('vo')->nullable();
            $table->integer('qty')->nullable();
            $table->string('lp')->nullable();
            $table->string('dp')->nullable();
            $table->string('matauang')->nullable();
            $table->integer('cif')->nullable();
            $table->integer('fob')->nullable();
            $table->integer('freight')->nullable();
            $table->date('shipschedule')->nullable();
            $table->string('tcd')->nullable();
            $table->string('surveyor')->nullable();
            $table->text('qas')->nullable();
            $table->string('top')->nullable();
            $table->string('delivery_basis')->nullable();
            $table->string('contract_dur')->nullable();
            $table->string('po')->nullable();
            $table->date('tglSurat')->nullable();
            $table->string('ttd')->nullable();
            $table->string('namaTtd')->nullable();
            $table->string('kop')->nullable();
            $table->string('qr')->nullable();
            $table->string('approve')->default('0');
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_s_s');
    }
}
