<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/*
 * Instantiation
 */

it('requires a title, employer ID, salary, and url', function () {
    $this->expectException(QueryException::class);

    // Create job with missing fields
    Job::create([]);
});

/**
 * Abilities
 */
it('can attach a tag', function () {
    // Arrange
    $job = Job::factory()->create();
    $tag = Tag::factory()->create();

    // Act
    $job->tags()->attach($tag);

    // Assert
    expect($job->tags->first()->is($tag))->toBeTrue();
});

/**
 * Constraints
 */
it('can attach many tags', function () {
    // Arrange
    $job = Job::factory()->create();
    $tags = Tag::factory(10)->create();

    // Act
    $job->tags()->attach($tags);

    // Assert
    expect($job->tags)->toHaveCount(10)
        ->and($job->tags->pluck('id'))->toEqualCanonicalizing($tags->pluck('id'));
});

it('can get limit number of tags', function () {
    // Arrange
    $job = Job::factory()->create();
    $tags = Tag::factory(10)->create();

    // Act
    $job->tags()->attach($tags);

    // Assert
    $firstDefaultLimitTags  = $job->limitTags(); // default (5) no. of tags
    $firstThreeLimitTags    = $job->limitTags(3); // three tags
    expect($firstDefaultLimitTags->get())->toHaveCount(5)
        ->and($firstDefaultLimitTags->first()->is($tags[0]))

        ->and($firstThreeLimitTags->get())->toHaveCount(3)
        ->and($firstThreeLimitTags->first()->is($tags[0]));
});


/*
 * Relationships
 */

it('belongs to an employer', function () {
    // Arrange
    $job = Job::factory()->create();

    // Act and Assert
    expect($job->employer())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to many tags', function () {
    // Arrange
    $job = Job::factory()->create();

    // Act and Assert
    expect($job->tags())->toBeInstanceOf(BelongsToMany::class);
});

