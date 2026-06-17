<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('UserID');
            $table->unsignedBigInteger('RoleID');
            $table->unsignedBigInteger('StoreID');
            $table->string('Nama', 150);
            $table->string('Username', 100)->unique();
            $table->string('Email', 150)->unique();
            $table->string('Password', 255);
            $table->boolean('StatusAktif')->default(1);
            $table->dateTime('LastLogin')->nullable();
            $table->timestamp('CreatedAt')->useCurrent()->nullable();
            $table->timestamp('UpdatedAt')->useCurrent()->useCurrentOnUpdate()->nullable();

            // Note: role table is not provided in your query, but we add foreign key if you want
            // $table->foreign('RoleID', 'fk_users_role')->references('RoleID')->on('role');
            $table->foreign('StoreID', 'fk_users_store')->references('StoreID')->on('store');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};