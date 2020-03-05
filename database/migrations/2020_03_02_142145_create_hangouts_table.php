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

            $table->boolean('movie-night')->default(0);
            $table->boolean('game-night')->default(0);
            $table->boolean('speed-dating')->default(0);
            $table->boolean('pub quiz')->default(0);
            $table->boolean('watching-games')->default(0);
            $table->boolean('open-mic-night')->default(0);
            $table->boolean('camping')->default(0);
            $table->boolean('drinking-activities')->default(0);

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
