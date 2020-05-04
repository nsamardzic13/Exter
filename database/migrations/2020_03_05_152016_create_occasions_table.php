<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccasionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occasions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('street');
            $table->decimal('lat', 8, 6)->nullable();
            $table->decimal('lng', 8, 6)->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('user_name'); //user_id
            $table->string('category');
            $table->integer('max_people')->default(0);
            $table->string('description');
            $table->string('picture')->nullable();
            $table->boolean('ended')->default(0);
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
        Schema::dropIfExists('occasions');
    }
}
