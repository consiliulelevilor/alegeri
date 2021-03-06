<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveQuestionsFromUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('question1');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('question2');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('question3');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('question4');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('user_question1', 'question1');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('user_question2', 'question2');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('user_question3', 'question3');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('user_question4', 'question4');
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
            $table->text('question1')->nullable();
            $table->text('question2')->nullable();
            $table->text('question3')->nullable();
            $table->text('question4')->nullable();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('question1', 'user_question1');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('question2', 'user_question2');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('question3', 'user_question3');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('question4', 'user_question4');
        });
    }
}
