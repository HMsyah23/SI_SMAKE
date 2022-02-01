<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->uuid('id', 32)->primary();
            $table->string('gelar_depan',20)->nullable();
            $table->string('nama_depan',50);
            $table->string('nama_belakang',50)->nullable();
            $table->string('gelar_belakang',30)->nullable();
            $table->string('status',1);
            $table->string('nip',18)->unique()->nullable();
            $table->bigInteger('pangkat_id')->unsigned()->nullable();;
            $table->foreign('pangkat_id')
                ->references('id')
                ->on('pangkats')->onDelete('cascade');
                $table->bigInteger('jabatan_id')->unsigned()->nullable();;
            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatans')->onDelete('cascade');
                $table->bigInteger('eselon_id')->unsigned()->nullable();;
            $table->foreign('eselon_id')
                ->references('id')
                ->on('eselons')->onDelete('cascade');
            $table->uuid('divisi_id',32)->nullable();
            $table->foreign('divisi_id')
                ->references('id')
                ->on('divisis')
                ->onDelete('cascade');
            $table->string('email')->unique()->nullable();
            $table->text('picture')->nullable();
            $table->string('keterangan',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
