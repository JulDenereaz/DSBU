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
        Schema::create('data_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('data_subcategory');
            $table->string('description')->nullable();
            $table->foreignId('data_category_id')->constrained('data_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_subcategories');
    }
};
