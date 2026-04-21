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
        Schema::create('regis_ulangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('peserta_id');
            $table->foreignUuid('event_id');
            $table->foreignUuid('gate_id');
            $table->dateTime('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regis_ulangs');
    }
};
