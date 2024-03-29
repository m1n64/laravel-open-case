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
        Schema::create('skins', function (Blueprint $table) {
            $table->id();
            $table->string('skin_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->boolean('stattrak')->default(false);
            $table->boolean('souvenir')->default(false);
            $table->integer('paint_index');
            $table->float('min_float')->nullable();
            $table->float('max_float')->nullable();
            $table->integer('weapon_id');
            $table->foreign('weapon_id')->references('id')->on('weapons');
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('rarity_id');
            $table->foreign('rarity_id')->references('id')->on('rarities');
            $table->integer('pattern_id')->nullable();
            $table->foreign('pattern_id')->references('id')->on('patterns');
            $table->timestamps();
        });

        Schema::create('skin_wear', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skin_id')->constrained()->onDelete('cascade');
            $table->foreignId('wear_id')->constrained('wears')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('collection_skin', function (Blueprint $table) {
            $table->id();
            $table->integer('collection_id');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreignId('skin_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('weapon_case_skin', function (Blueprint $table) {
            $table->id();
            $table->integer('weapon_case_id');
            $table->foreign('weapon_case_id')->references('id')->on('weapon_cases')->onDelete('cascade');
            $table->foreignId('skin_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skins');
        Schema::dropIfExists('skin_wear');
        Schema::dropIfExists('collection_skin');
        Schema::dropIfExists('weapon_case_skin');
    }
};
