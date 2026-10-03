<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    /** @use HasFactory<\Database\Factories\LeadFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'source',
        'status',
        'desired_bedrooms',
        'budget',
        'desired_move_in',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'decimal:2',
            'desired_move_in' => 'date',
        ];
    }

    /**
     * @return HasMany<Tour, $this>
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    /**
     * @return HasMany<Lease, $this>
     */
    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }
}
