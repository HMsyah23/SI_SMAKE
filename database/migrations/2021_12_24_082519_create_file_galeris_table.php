<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileGalerisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_galeris', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('galeri_id')->unsigned();
            $table->string('url',200);
            $table->text('deskripsi');
            $table->foreign('galeri_id')
                ->references('id')
                ->on('galeris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galeri_file');
    }
}
