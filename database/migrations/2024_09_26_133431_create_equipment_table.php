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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('eq_id');
            $table->string('shortname');
            $table->string('name');
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
            $table->foreignId('data_category_id')->constrained('data_categories')->onDelete('cascade');
            $table->string('location');
            $table->string('software')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
