<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avis extends Model
{
    use HasFactory,InteractsWithMedia,
    SoftDeletes;



    protected $fillable = [
        'code',
        'note',
        'commentaire',
        'user_id',
        'produit_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
