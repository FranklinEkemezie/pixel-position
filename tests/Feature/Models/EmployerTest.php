<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Instantiation
 */

it('requires a name and user ID', function () {
    $this->expectException(QueryException::class);

    // Create employer with missing fields
    Employer::create([]);
});

/**
 * Abilities
 */

it('can create a job', function () {
    // Arrange
    $employer = Employer::factory()->create();

    // Act
    $job = Job::factory()->for($employer)->create();

    // Assert
    expect($job)->toBeInstanceOf(Job::class)
        ->and($job->employer_id)->toBe($employer->id);
});

/**
 * Constraints
 */

it('can create many jobs', function () {
    // Arrange
    $employer = Employer::factory()->create();

    // Act
    $jobs = Job::factory(10)->create(['employer_id' => $employer->id]);

    // Assert
    expect($employer->jobs->pluck('id')->sort()->values())
        ->toEqual($jobs->pluck('id')->sort()->values());
});

/**
 * Relationships
 */

it('belongs to a user', function () {
    // Arrange
    $employer = Employer::factory()->create();

    // Act and Assert
    expect($employer->user())->toBeInstanceOf(BelongsTo::class);
});

it('has many jobs', function () {
    // Arrange
    $employer = Employer::factory()->create();

    // Act and Assert
    expect($employer->jobs())->toBeInstanceOf(HasMany::class);
});

