<?php

namespace App\Models;

use App\Models\Option;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold'
    ];

    protected $casts = [
        'sold' => 'boolean'
    ];

    // Permet a un bien d'avoir plusieurs options
    public function options (): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    // Permet de generé le slug des biens a partir de leurs titres
    public function getSlug(): string
    {
        return Str::slug($this->title);
    }

    public function scopeAvailable (Builder $builder, bool $available = true): Builder
    {
        // Affiche les biens qui n'ont pas été vendu
        return $builder->where('sold', !$available);
    }

    public function scopeRecent(Builder $builder): Builder
    {
        return $builder->orderBy('created_at', 'desc');
    }
}
