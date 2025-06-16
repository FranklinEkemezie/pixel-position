<?php

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Instantiation
 */
it('requires name', function () {
   $this->expectException(QueryException::class);

   Tag::create([]);
});

/**
 * Abilities
 */
it('can be assigned to a job', function () {
    // Arrange
    $tag = Tag::factory()->create();
    $job = Job::factory()->create();

    // Act
    $tag->jobs()->attach($job);

    // Assert
    expect($tag->jobs->first()->is($job))->toBeTrue();
});

/**
 * Constraints
 */
it('can be assigned to many jobs', function () {
    // Arrange
   $tag = Tag::factory()->create();
   $jobs = Job::factory(10)->create();

   // Act
   $tag->jobs()->attach($jobs);

   // Assert
    expect($tag->jobs)->toHaveCount(10)
        ->and($tag->jobs->pluck('id'))->toEqualCanonicalizing($jobs->pluck('id'));
});

/**
 * Relationships
 */

it('belongs to many jobs', function () {
    // Arrange
    $tag = Tag::factory()->create();
    $jobs = Job::factory(10)->create();

    // Act
    $tag->jobs()->attach($jobs);

    // Assert
    expect($tag->jobs())->toBeInstanceOf(BelongsToMany::class);
});
