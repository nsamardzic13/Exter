<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index()->unique();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('football')->default(0);
            $table->boolean('basketball')->default(0);
            $table->boolean('handball')->default(0);
            $table->boolean('tennis')->default(0);
            $table->boolean('water-polo')->default(0);
            $table->boolean('cycling')->default(0);
            $table->boolean('squash')->default(0);
            $table->boolean('hiking')->default(0);
            $table->boolean('badminton')->default(0);
            $table->boolean('bowling')->default(0);
            $table->boolean('fitness')->default(0);
            $table->boolean('rugby')->default(0);

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
        Schema::dropIfExists('sports');
    }
}
