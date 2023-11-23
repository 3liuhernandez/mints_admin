<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->default("Student");
            $table->string('last_name', 100)->nullable();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('phone', 20)->nullable();
            $table->string('phone_other', 20)->nullable();

            // role_id 3 == student
            $table->unsignedTinyInteger('role_id')->default(3);
            $table->foreign('role_id')->references('code')->on('user_types');

            // estatus_code 2 == inactivo
            $table->unsignedTinyInteger('status')->default(2);
            $table->foreign('status')->references('code')->on('user_statuses');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        $seeder = new \Database\Seeders\DatabaseSeeder();
        $seeder->call(\Database\Seeders\UserSeeder::class);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
