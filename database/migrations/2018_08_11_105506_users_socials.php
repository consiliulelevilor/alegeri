<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersSocials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_socials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('social_id');
            $table->enum('social_type', ['facebook', 'google', 'instagram']);

            $table->string('email')->nullable();
            $table->string('nickname')->nullable();
            $table->string('name')->nullable();
            $table->text('avatar_url')->nullable();

            $table->text('token')->nullable();
            $table->timestamp('token_expiry')->nullable();
            $table->mediumText('socialite')->nullable();

            $table->boolean('is_public')->default(false);

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
        Schema::dropIfExists('users_socials');
    }
}
