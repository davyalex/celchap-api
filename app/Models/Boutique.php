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

class Boutique extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,
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
    'phone',
    'indicatif',
    'devise',
    'description',
    'user_id',
    'category_id',
    'created_at',
    'updated_at',
    'deleted_at'
];

public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id');
}

public function categorie(): BelongsTo 
{
    return $this->belongsTo(Categorie::class, 'category_id');
}

public function produits(): HasMany
{
    return $this->hasMany(Produit::class);
}

public function commande_produits(): HasMany
{
    return $this->hasMany(CommandeProduit::class);
}


public function commandes(): BelongsToMany
{
    return $this->belongsToMany(Boutique::class, 'boutique_commande', 'boutique_id','commande_id')
    ->withPivot('quantite', 'prix_vendeur','montant_ajouter','prix_afficher','total')
    ->withTimestamps();
}




}
