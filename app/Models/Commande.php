<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Commande extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'description',
        'nombre_produit',
        'sous_total',
        'tarif_livraison',
        'montant_total',
        'status',
        'user_id',
        'boutique_id',
        'livraison_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function livraison(): BelongsTo
    {
        return $this->belongsTo(Livraison::class, 'livraison_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function produits(): BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'commande_produit','commande_id', 'produit_id')
        ->withPivot('quantite', 'prix_vendeur','montant_ajouter','prix_afficher','total','boutique_id')
        ->withTimestamps();
    }


    public function boutiques(): BelongsToMany
    {
        return $this->belongsToMany(Boutique::class, 'commande_produit', 'commande_id','boutique_id')
        // ->withPivot('quantite', 'prix_vendeur','montant_ajouter','prix_afficher','total')
        ->withTimestamps();
    }

    




}
