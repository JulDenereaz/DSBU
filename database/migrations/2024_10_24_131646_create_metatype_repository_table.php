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
        Schema::create('metatype_repository', function (Blueprint $table) {
            $table->foreignId('metatype_id')->constrained('metatypes')->onDelete('cascade');
            $table->foreignId('repository_id')->constrained('repositories')->onDelete('cascade');
            $table->primary(['metatype_id', 'repository_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metatype_repository');
    }
};
