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
            $table->string('status');
            $table->string('collection_date');
            $table->string('project_id');
            $table->string('user_id');
            $table->string('equipment_id');
            $table->string('protocol_id');
            $table->string('data_type');
            $table->string('samples');
            $table->string('description');
            $table->string('file_structure');
            $table->string('supp_table');
            $table->string('is_personal');
            $table->string('is_sensitive');
            $table->string('is_encrypted');
            $table->string('is_archived');
            $table->string('is_deposited');
            $table->string('storage_period');
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
