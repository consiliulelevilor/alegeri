<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profile_name')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('institution')->nullable();

            $table->date('starting_year')->nullable();
            $table->date('graduation_year')->nullable();

            $table->boolean('is_admin')->default(false);
            $table->string('password')->nullable();
            $table->rememberToken();

            $table->uuid('activation_token')->nullable();
            $table->boolean('is_subscribed')->default(true);

            $table->timestamps();
            $table->softDeletes();
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
