<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->index('campaign_id');
            $table->index('user_id');
            $table->index('user_name');
            $table->index('user_email');
            $table->index('user_city');
            $table->index('user_region');
            $table->index('user_institution');
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->index('name');
            $table->index('type');
            $table->index('opened_until');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('profile_name');
            $table->index('name');
            $table->index('email');
            $table->index('phone');
            $table->index('city');
            $table->index('region');
            $table->index('institution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropIndex('applications_campaign_id_index');
            $table->dropIndex('applications_user_id_index');
            $table->dropIndex('applications_user_name_index');
            $table->dropIndex('applications_user_email_index');
            $table->dropIndex('applications_user_city_index');
            $table->dropIndex('applications_user_region_index');
            $table->dropIndex('applications_user_institution_index');
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropIndex('campaigns_name_index');
            $table->dropIndex('campaigns_type_index');
            $table->dropIndex('campaigns_opened_until_index');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_profile_name_index');
            $table->dropIndex('users_name_index');
            $table->dropIndex('users_email_index');
            $table->dropIndex('users_phone_index');
            $table->dropIndex('users_city_index');
            $table->dropIndex('users_region_index');
            $table->dropIndex('users_institution_index');
        });
    }
}
