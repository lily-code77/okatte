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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id'); //追加:user_id
            $table->string('title');
            $table->string('tags')->nullable();
            $table->string('intro')->nullable();
            $table->string('image')->nullable();
            $table->string('ing');
            $table->string('ins');
            $table->string('comment')->nullable();
            $table->string('memo')->nullable();
            $table->enum('status', ['draft', 'publish']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
