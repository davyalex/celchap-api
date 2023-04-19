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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->double('q_min')->nullable();;
            $table->double('q_max')->nullable();;
            $table->double('prix_vendeur')->nullable(); /** prix du vendeur */
            $table->double('montant_ajouter')->nullable(); /**prix ajouter par administrateur */
            $table->double('prix_afficher')->nullable(); /** montant ajouter + prix_vendeur */
            $table->foreignId('produit_id')
            ->nullable()
            ->constrained('produits')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
