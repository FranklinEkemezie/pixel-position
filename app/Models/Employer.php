<?php

namespace App\Models;

use Database\Factories\EmployerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property $id
 * @property $name
 * @property $logo
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Collection<Job> $jobs
 */
class Employer extends Model
{
    /** @use HasFactory<EmployerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Job>
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

}
