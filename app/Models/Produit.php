<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produit extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        SoftDeletes,
        HasRoles,
        HasSlug,
        HasPermissions;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'code',
        'slug',
        'name',
        'type',
        // 'prix_vendeur',
        // 'montant_ajouter',
        // 'prix_afficher',
        'prix_promo',
        'date_debut_promo',
        'date_fin_promo',
        'disponibilite',
        'description',
        'sous_category_id',
        'category_id',
        'boutique_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

   public function sous_categorie(): BelongsTo
    {
        return $this->belongsTo(SousCategorie::class, 'sous_category_id');
    }

    public function grossistes(): HasMany
    {
        return $this->hasMany(Grossiste::class);
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

  public function commandes(): BelongsToMany
    {
        return $this->belongsToMany(Commande::class, 'commande_produit','produit_id', 'commande_id')
        ->withPivot('quantite', 'prix_vendeur','montant_ajouter','prix_afficher','total','boutique_id')
        ->withTimestamps();
        
    }

}
