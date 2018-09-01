<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->enum('color_scheme', ['default', 'primary', 'secondary', 'info', 'success', 'danger', 'warning'])->default('success');
            $table->enum('type', ['executive', 'regional', 'institutional'])->default('executive');
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('opened_until')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campaign_id');
            $table->integer('user_id');
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_city')->nullable();
            $table->string('user_region')->nullable();
            $table->string('user_institution')->nullable();
            $table->integer('user_starting_year')->nullable();
            $table->text('user_description')->nullable();
            $table->text('user_question1')->nullable();
            $table->text('user_question2')->nullable();
            $table->text('user_question3')->nullable();
            $table->text('user_question4')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
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
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('applications');
    }
}
