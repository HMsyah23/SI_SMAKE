<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampiranSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lampiran_surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->uuid('surat_keluar_id', 32);
            $table->text('lampiran');
            $table->foreign('surat_keluar_id')
                ->references('id')
                ->on('surat_keluars')->onDelete('cascade');
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
        Schema::dropIfExists('lampiran_surat_keluar');
    }
}
