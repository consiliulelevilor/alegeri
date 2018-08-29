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

            $table->string('name')->nullable();
            $table->string('email')->nullable();

            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('institution')->nullable();
            $table->integer('starting_year')->nullable();

            $table->text('description')->nullable();

            $table->text('question1')->nullable();
            $table->text('question2')->nullable();
            $table->text('question3')->nullable();
            $table->text('question4')->nullable();

            $table->boolean('is_admin')->default(false);
            $table->string('password')->nullable();
            $table->rememberToken();

            $table->uuid('activation_token')->nullable();
            $table->boolean('is_mail_subscribed')->default(true);

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
