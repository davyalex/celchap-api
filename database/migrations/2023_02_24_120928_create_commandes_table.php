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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('description')->nullable();
            $table->integer('quantite')->nullable();
            $table->double('sous_total')->nullable();
            $table->double('tarif_livraison')->nullable();
            $table->double('montant_total')->nullable();
            $table->string('status')->nullable(); // attente", en cour ,livré
            $table->string('disponibilite')->nullable(); //disponible, pas disponibe

           
            // $table->double('remise')->nullable();
            // $table->dateTime('livraison_prevue')->nullable();
            // $table->dateTime('livraison_exacte')->nullable();

            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->foreignId('boutique_id')
            ->nullable()
            ->constrained('boutiques')
            ->onUpdate('cascade')
            ->onDelete('set null');

            
            $table->foreignId('produit_id')
            ->nullable()
            ->constrained('produits')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->foreignId('livraison_id')
            ->nullable()
            ->constrained('livraisons')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
