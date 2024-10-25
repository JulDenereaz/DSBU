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
        Schema::create('data_category_repository', function (Blueprint $table) {
            $table->foreignId('data_category_id')->constrained('data_categories')->onDelete('cascade');
            $table->foreignId('repository_id')->constrained('repositories')->onDelete('cascade');
            $table->primary(['data_category_id', 'repository_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_category_repository');
    }
};
