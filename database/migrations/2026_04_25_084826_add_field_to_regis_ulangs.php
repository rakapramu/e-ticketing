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
        Schema::table('regis_ulangs', function (Blueprint $table) {
            $table->foreignUuid('order_id')->after('id')->nullable();
            $table->foreignUuid('gate_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('regis_ulangs', function (Blueprint $table) {
            //
        });
    }
};
