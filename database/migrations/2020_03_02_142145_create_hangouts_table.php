<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHangoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hangouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('movie_night')->default(0);
            $table->boolean('game_night')->default(0);
            $table->boolean('speed_dating')->default(0);
            $table->boolean('pub_quiz')->default(0);
            $table->boolean('open_mic_night')->default(0);
            $table->boolean('camping')->default(0);
            $table->boolean('drunk_activities')->default(0);

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
        Schema::dropIfExists('hangouts');
    }
}
