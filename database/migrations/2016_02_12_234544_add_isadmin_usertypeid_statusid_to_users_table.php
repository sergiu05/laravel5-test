<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsadminUsertypeidStatusidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('email');
            $table->integer('user_type_id')->default(10)->unsigned()->after('is_admin');
            $table->integer('status_id')->default(10)->unsigned()->after('user_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('user_type_id');
            $table->dropColumn('status_id');
        });
    }
}
