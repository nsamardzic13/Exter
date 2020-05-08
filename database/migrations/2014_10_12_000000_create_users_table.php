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
            $table->string('name')->nullable()->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->year('birth_year')->nullable();
            $table->string('email')->unique();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('street_name')->nullable();
            $table->decimal('lat', 12, 6)->nullable();
            $table->decimal('lng', 12, 6)->nullable();
            $table->string('phone_number')->nullable();
            $table->string('description')->nullable();
            $table->boolean('user_type')->nullable();
            $table->string('profile_pic')->default('uploads\/user_default_pic.png');
            $table->longText('user_gallary')->nullable();
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
