<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeri_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('galeri_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->foreign('galeri_id')
                ->references('id')
                ->on('galeris')->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galeri_tag');
    }
}
