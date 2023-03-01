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

class SousCategorie extends Model implements HasMedia
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
        'category_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }


}
