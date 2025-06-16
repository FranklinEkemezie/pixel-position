<?php

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

test('GET /tags/{name} displays jobs with tag', function () {
    // Arrange
    $job = Job::factory()->create();
    $tag = Tag::factory()->create(['name' => 'hello']);

    $job->tags()->attach($tag);

    // Act
    $response = get('/tags/hello');

    // Assert
    $response->assertOk()
        ->assertViewIs('jobs.search_results')
        ->assertViewHasAll(['jobs']);
    expect($response->viewData('jobs')->links()) // expect pagination for 'jobs'
        ->toBeInstanceOf(\Illuminate\View\View::class);
});

test('GET /tags/{name} throws 404 if tag is not found', function () {
    // Arrange

    // Act
    get('/tags/world')

    // Assert
        ->assertNotFound();
});

test('GET /tags displays all tags', function () {
    // Arrange
    Tag::factory(10)->create();

    // Act
    $response = get('/tags');

    // Assert
    $response->assertOk()
        ->assertViewIs('tags.index')
        ->assertViewHasAll(['tags']);
    expect($response->viewData('tags')->links())
        ->toBeInstanceOf(Illuminate\View\View::class); // expect pagination
});
