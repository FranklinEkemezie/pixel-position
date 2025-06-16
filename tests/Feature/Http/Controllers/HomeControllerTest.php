<?php

use function Pest\Laravel\get;

it('shows the index page', function () {
    // Arrange

    // Act
    $response = get('/');

    // Assert
    $response->assertOk();
    $response->assertViewIs('home.index');
    $response->assertViewHasAll([
        'featuredJobs',
        'recentJobs',
        'tags'
    ]);
    expect($response->viewData('recentJobs')->links()) // expect pagination for 'recentJobs'
        ->toBeInstanceOf(\Illuminate\View\View::class);

});
