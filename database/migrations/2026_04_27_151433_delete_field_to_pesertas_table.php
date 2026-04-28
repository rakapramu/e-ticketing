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
        Schema::table('pesertas', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->string('id_participant')->nullable();
            $table->foreignUuid('user_id');
            $table->string('no_wa')->nullable()->change();
            $table->longText('alamat')->nullable()->change();
            $table->string('title_of_specialist')->nullable();
            $table->string('name_on_certificate')->nullable();
            $table->string('institution')->nullable();
            $table->string('division')->nullable();
            $table->bigInteger('province_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {
            //
        });
    }
};
