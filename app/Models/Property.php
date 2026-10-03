<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'property_type',
        'neighborhood',
        'state',
        'zip',
        'description',
        'price',
        'image_url',
        'featured',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'is_published' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Amenity, $this>
     */
    public function amenities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    /**
     * @return HasMany<Unit, $this>
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * @return HasManyThrough<Lease, Unit, $this>
     */
    public function leases(): HasManyThrough
    {
        return $this->hasManyThrough(Lease::class, Unit::class);
    }
}
