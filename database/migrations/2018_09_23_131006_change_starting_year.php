<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStartingYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('class')->after('institution')->default('IX')->nullable();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->string('user_class')->after('user_institution')->default('IX')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('starting_year');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('user_starting_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('class');
            $table->integer('starting_year')->after('institution')->nullable();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('user_class');
            $table->integer('user_starting_year')->after('user_institution')->nullable();
        });
    }
}
