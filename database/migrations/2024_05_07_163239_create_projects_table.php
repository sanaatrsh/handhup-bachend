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
        Schema::create('projects', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('owner_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->unique()->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('imagePath')->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
