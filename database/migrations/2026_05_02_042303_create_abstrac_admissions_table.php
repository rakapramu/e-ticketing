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
        Schema::create('abstrac_admissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('peserta_id');
            $table->string('judul');
            $table->string('file');
            $table->enum('status', ['validated', 'unvalidated']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abstrac_admissions');
    }
};
