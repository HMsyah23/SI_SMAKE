<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('berita_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->foreign('berita_id')
                ->references('id')
                ->on('beritas')->onDelete('cascade');
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
        Schema::dropIfExists('berita_tag');
    }
}
