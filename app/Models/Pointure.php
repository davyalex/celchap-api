<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pointure extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'produit_id'
    ];

 
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
