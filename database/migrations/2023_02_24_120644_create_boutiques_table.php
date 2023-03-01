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
        Schema::create('boutiques', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('slug')->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('devise')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('indicatif')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
            
            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boutiques');
    }
};
