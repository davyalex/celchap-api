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
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model implements HasMedia
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
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function sous_categories(): HasMany
    {
        return $this->hasMany(SousCategorie::class);
    }


    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }


}
