<?php

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the index page', function () {
    // Arrange
    $job = Job::factory(10)->create();

    // Act
    $response = $this->get('/');

    // Assert
    $response->assertOk();
    $response->assertViewIs('index');
    $response->assertViewHasAll([
        'featuredJobs',
        'recentJobs',
        'tags'
    ]);
    expect($response->viewData('recentJobs')->links()) // expect pagination for 'recentJobs'
        ->toBeInstanceOf(\Illuminate\View\View::class);

});
