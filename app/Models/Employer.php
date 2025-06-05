<?php

namespace App\Models;

use Database\Factories\EmployerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $user_id
 * @property $name
 * @property $logo
 * @property $created_at
 * @property $updated_at
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

}
