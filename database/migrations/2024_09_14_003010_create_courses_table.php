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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('title', 100)->unique();
            $table->string('description')->nullable();

            $table->unsignedTinyInteger('type')->default(1);
            $table->foreign('type')->references('code')->on('course_types');

            $table->unsignedTinyInteger('status')->default(1);
            $table->foreign('status')->references('code')->on('course_statuses');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
