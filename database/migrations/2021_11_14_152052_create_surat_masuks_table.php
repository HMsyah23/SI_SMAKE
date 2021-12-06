<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->uuid('id', 32)->primary();
            $table->uuid('divisi_id',32)->nullable();
            $table->string('divisi');
            $table->string('nomor_surat');
            $table->string('asal_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_terima');
            $table->string('no_agenda');
            $table->string('sifat');
            $table->string('tipe');
            $table->string('perihal');
            $table->string('catatan');
            $table->string('noted');
            $table->text('file');
            $table->text('tanda_tangan');
            $table->boolean('isValid');
            $table->boolean('isDisposisi');
            $table->timestamps();

            $table->foreign('divisi_id')
                    ->references('id')
                    ->on('divisis')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuks');
    }
}
