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
        Schema::create('boutique_commande', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite')->nullable();
            $table->double('prix_vendeur')->nullable();
            $table->double('montant_ajouter')->nullable();
            $table->double('prix_afficher')->nullable();
            $table->double('total')->nullable(); //prix_afficher * quantite           

            $table->foreignId('commande_id')
            ->nullable()
            ->constrained('commandes')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->foreignId('boutique_id')
            ->nullable()
            ->constrained('boutiques')
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
        Schema::dropIfExists('boutique_commande');
    }
};
