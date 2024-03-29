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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('cs_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('team_id');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->integer('rarity_id')->nullable();
            $table->foreign('rarity_id')->references('id')->on('rarities');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('collection_agent', function (Blueprint $table) {
            $table->id();
            $table->integer('collection_id');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
        Schema::dropIfExists('collection_agent');
    }
};
