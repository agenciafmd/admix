<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CustomizeUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')
                ->default(1);
            $table->integer('role_id')
                ->unsigned()
                ->default('0')
                ->after('password');
            $table->string('type')
                ->nullable();
            $table->string('api_token', 60)
                ->after('password')
                ->unique()
                ->nullable()
                ->default(null);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
