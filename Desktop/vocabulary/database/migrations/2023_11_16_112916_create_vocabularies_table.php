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
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('word_uz');
            $table->string('word_en')->unique();
            $table->string('description')->nullable();
            $table->string('spelling')->nullable();
            $table->string('audio')->nullable();
            $table->string('category')->nullable();
            $table->string('vocab_photos')->nullable();
            $table->string('vocab_example')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabularies');
    }
};
