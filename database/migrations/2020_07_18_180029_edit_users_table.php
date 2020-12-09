<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->nullable()->after('email');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->string('user_name')->nullable()->after('password');
            $table->string('first_name')->nullable()->after('user_name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('gender')->after('last_name')->nullable();
            $table->string('phone_number')->nullable()->after('gender');

            $table->boolean('is_active')->nullable()->after('phone_number');
            $table->integer('country_id')->unsigned()->nullable()->after('is_active');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

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
            //
        });
    }
}
