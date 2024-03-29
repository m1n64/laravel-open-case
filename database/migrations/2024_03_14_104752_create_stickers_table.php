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
        Schema::create('stickers', function (Blueprint $table) {
            $table->id();
            $table->string('cs_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('rarity_id')->nullable();
            $table->foreign('rarity_id')->references('id')->on('rarities');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('weapon_case_sticker', function (Blueprint $table) {
            $table->id();
            $table->integer('weapon_case_id');
            $table->foreign('weapon_case_id')->references('id')->on('weapon_cases')->onDelete('cascade');
            $table->foreignId('sticker_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stickers');
        Schema::dropIfExists('weapon_case_sticker');
    }
};
