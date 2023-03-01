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
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->integer('note')->nullable();
            $table->string('commentaire')->nullable();
            $table->softDeletes();
            $table->timestamps();

            
            $table->foreignId('produit_id')
            ->nullable()
            ->constrained('produits')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
