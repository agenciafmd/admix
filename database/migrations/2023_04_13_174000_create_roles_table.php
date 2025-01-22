<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', static function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')
                ->default(1)
                ->index();
            $table->string('name');
            $table->longText('rules');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
