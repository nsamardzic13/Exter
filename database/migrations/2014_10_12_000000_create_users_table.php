<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            /*$table->string('first_name');
            $table->string('last_name');*/
            $table->year('birth_year')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('street_name')->nullable();
            $table->string('city_name')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('description')->nullable();
            $table->boolean('user_type');
            $table->string('profile_pic')->nullable();
            /*$table->string('file_path');*/
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
