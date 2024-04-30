<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->after('id', static function (Blueprint $table) {
                $table->boolean('is_active')
                    ->default(0)
                    ->index();
                $table->string('type')
                    ->nullable();
            });
            $table->after('remember_token', static function (Blueprint $table) {
                $table->string('api_token', 80)
                    ->unique()
                    ->nullable();
                $table->foreignId('role_id')
                    ->nullable()
                    ->index()
                    ->constrained();
                $table->boolean('can_notify')
                    ->default(0);
                $table->json('library')
                    ->nullable();
            });
            $table->softDeletes();
        });
    }
};
