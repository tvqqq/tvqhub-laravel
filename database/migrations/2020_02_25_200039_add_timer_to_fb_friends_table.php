<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimerToFbFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fb_friends', function (Blueprint $table) {
            $table->unsignedTinyInteger('timer')->nullable()->after('is_crush');
            $table->dropColumn('is_crush');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_friends', function (Blueprint $table) {
            $table->addColumn('tinyInteger', 'is_crush')->after('timer');
            $table->dropColumn('timer');
        });
    }
}
