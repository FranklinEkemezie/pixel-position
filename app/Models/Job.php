<?php

namespace App\Models;

use Database\Factories\JobFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property string $salary
 * @property int $employer_id
 * @property string $url
 * @property string $location
 * @property string $schedule
 * @property bool $featured
 * @property $created_at
 * @property $updated_at
 */
class Job extends Model
{
    /** @use HasFactory<JobFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'salary',
        'url',
        'location',
        'schedule',
        'featured',
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function limitTags(int $limit=5): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->limit($limit);
    }
}
