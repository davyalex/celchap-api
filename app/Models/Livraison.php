<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livraison extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'lieu',
        'tarif',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }

}
