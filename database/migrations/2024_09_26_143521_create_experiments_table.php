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
            $table->enum('status', ['INCOMPLETE', 'READY', 'CREATED', 'ARCHIVED', 'DELETED'])->default('INCOMPLETE');
            $table->date('collection_date')->format('Ymd');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');
            $table->foreignId('protocol_id')->constrained('protocols')->onDelete('cascade');
            $table->foreignId('data_method_id')->constrained('data_methods')->onDelete('cascade');
            $table->string('samples')->nullable();
            $table->string('description')->nullable();
            $table->string('file_structure')->nullable();
            $table->string('supp_table')->nullable();
            $table->boolean('is_personal')->nullable();
            $table->boolean('is_sensitive')->nullable();
            $table->boolean('is_encrypted')->nullable();
            $table->boolean('is_archived')->nullable();
            $table->boolean('is_deposited')->nullable();
            $table->string('storage_period')->nullable();
            $table->string('license')->nullable();
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
