<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisiSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisi_surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->uuid('surat_masuk_id', 32);
            $table->foreign('surat_masuk_id')
                ->references('id')
                ->on('surat_masuks')->onDelete('cascade');
            $table->uuid('divisi_id', 32);
            $table->foreign('divisi_id')
                ->references('id')
                ->on('divisis')->onDelete('cascade');
            $table->date('tanggal_dibaca');
            $table->boolean('isDibaca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisi_surat_masuk');
    }
}
