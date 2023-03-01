<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grossiste extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nombre',
        'prix',
        'produit_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function produits(): BelongsTo
{
    return $this->belongsTo(Produit::class, 'produit_id');
}

}
