<?php

use App\Models\Employer;
use App\Models\Job;
use function Pest\Laravel\get;

test('GET /employers displays list of employers', function () {
    // Arrange
    Employer::factory(10)->create();

    // Act
    $response = get('/employers');

    // Assert
    $response->assertOk()
        ->assertViewIs('employers.index')
        ->assertViewHasAll(['employers']);
    expect($response->viewData('employers')->links())
        ->toBeInstanceOf(\Illuminate\View\View::class);
});

test('GET /employers/{name} displays jobs with employer', function () {
    // Arrange
    $employer   = Employer::factory()->create(['name' => 'ABC Corps.']);
    Job::factory(10)->create(['employer_id' => $employer->id]);

    // Act
    $response = get('employers/ABC Corps.');

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
    get('/employers/CDE Corps.')

        // Assert
        ->assertNotFound();
});


