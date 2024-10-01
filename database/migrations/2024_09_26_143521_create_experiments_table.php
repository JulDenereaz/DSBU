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
        Schema::create('experiments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['INCOMPLETE', 'READY', 'CREATED', 'ARCHIVED'])->default('INCOMPLETE');
            $table->date('collection_date')->format('Ymd');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');
            $table->foreignId('protocol_id')->constrained('protocols')->onDelete('cascade');
            $table->foreignId('data_subcategory_id')->constrained('data_subcategories')->onDelete('cascade');
            $table->string('samples');
            $table->string('description');
            $table->string('file_structure');
            $table->string('supp_table');
            $table->boolean('is_personal');
            $table->boolean('is_sensitive');
            $table->boolean('is_encrypted');
            $table->boolean('is_archived');
            $table->boolean('is_deposited');
            $table->boolean('storage_period');
            $table->string('License');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiments');
    }
};
