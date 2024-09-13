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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dni')->unique();
            $table->string('name', 100)->default("Student");
            $table->string('last_name', 100)->nullable();
            $table->string('email', 50)->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->string('phone_other', 20)->nullable();

            $table->string('profession', 100)->nullable();

            $table->string('city', 150)->nullable();
            $table->string('neighbourhood', 150)->nullable();
            $table->string('parish', 150)->nullable();
            $table->text('address')->nullable();

            $table->unsignedTinyInteger('member_iglc')->default(1)->comment("es miembro de la iglesia? 1 para si");

            $table->unsignedTinyInteger('status')->default(1);
            $table->foreign('status')->references('code')->on('user_statuses');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
