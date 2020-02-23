<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 50)->index();
            $table->enum('alert', ['info', 'success', 'warning', 'danger']);
            $table->text('content')->nullable();
            $table->string('post_id', 50)->nullable()->unique();
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
        Schema::dropIfExists('fb_logs');
    }
}
