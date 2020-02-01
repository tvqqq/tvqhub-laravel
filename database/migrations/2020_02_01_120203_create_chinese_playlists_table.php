<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChinesePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chinese_playlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vn_name');
            $table->string('cn_name');
            $table->string('artist');
            $table->string('mp3_url');
            $table->string('image_url');
            $table->string('color');
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
        Schema::dropIfExists('chinese_playlists');
    }
}
