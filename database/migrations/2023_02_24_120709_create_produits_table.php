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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->double('prix_vendeur')->nullable();
            $table->double('montant_ajouter')->nullable();
            $table->double('prix_afficher')->nullable();
            $table->double('prix_promo')->nullable();
            $table->date('date_debut_promo')->nullable();
            $table->date('date_fin_promo')->nullable();
            $table->string('disponibilite')->nullable(); 
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('sous_category_id')
            ->nullable()
            ->constrained('sous_categories')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('boutique_id')
            ->nullable()
            ->constrained('boutiques')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
