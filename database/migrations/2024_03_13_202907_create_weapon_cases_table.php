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
        Schema::create('weapon_cases', function (Blueprint $table) {
            $table->id();
            $table->string('cs_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('weapon_case_types')->onDelete('set null');
            $table->integer('key_id')->nullable();
            $table->foreign('key_id')->references('id')->on('keys')->onDelete('set null');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapon_cases');
    }
};
