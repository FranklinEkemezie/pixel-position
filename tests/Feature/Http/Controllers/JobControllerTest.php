<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('prevents unauthenticated user from accessing protected job routes', function () {
    get('/jobs/create')->assertRedirect('/register');
    post('/jobs')->assertRedirect('/register');
});

it('prevents unauthorised user from accessing guarded job routes ', function () {
    // Arrange
    $job = Job::factory()->create(); // create a job by another user
    actingAs(User::factory()->create()); // authenticate another user

    $jobId = $job->id;
    get("/jobs/$jobId/edit")->assertForbidden();
    patch("/jobs/$jobId")->assertForbidden();
    delete("/jobs/$jobId")->assertForbidden();
});

test('GET /jobs route displays jobs listing page', function () {
    // Arrange

    // Act
    $response = get('/jobs')

    // Assert
        ->assertOk()
        ->assertViewIs('home.index')
        ->assertViewHasAll(['featuredJobs', 'recentJobs', 'tags']);
    expect($response->viewData('recentJobs')->links()) // expect pagination for 'recentJobs'
        ->toBeInstanceOf(\Illuminate\View\View::class);
});

test('GET /jobs/create route displays a create job form', function () {
    // Arrange
    actingAs(User::factory()->create());

    // Act
    get('/jobs/create')

    // Assert
        ->assertOk()
        ->assertViewIs('jobs.create')
        ->assertSee([
            'title', 'salary', 'schedule', 'location', 'feature', 'url',
            'post', '_token', 'tags'
        ]);
});

test('POST /jobs route stores a new job', function () {
    // Arrange
    $user = Employer::factory()->create()->user;
    actingAs($user);

    $data = [
        'title'     => 'Web developer',
        'salary'    => '15,000 USD',
        'schedule'  => 'Full-time',
        'location'  => 'Abuja',
        'feature'   => 'on',
        'url'       => 'https://www.abc-company.com/jobs/web-developer-4355223',
        'tags'      => 'javascript,react, inertia,laravel, typescript'
    ];

    // Act
    $response = post('/jobs', $data);

    // Assert
    $response->assertRedirect('/dashboard');
    $jobs = $user->employer->jobs;

    expect($jobs)->toHaveCount(1)
        ->and($job = $jobs->first())->toBeInstanceOf(Job::class)
        ->and($job->employer->is($user->employer))->toBeTrue()
        ->and($job->title)->toBe('Web developer')
        ->and($job->salary)->toBe('15,000 USD')
        ->and($job->location)->toBe('Abuja')
        ->and($job->tags->pluck('name')->toArray())
            ->toEqualCanonicalizing(['javascript', 'react', 'inertia', 'laravel', 'typescript']);

});

test('GET /jobs/{job} display the job', function () {
    // Arrange
    $job = Job::factory()->create();

    // Act
    $response = get("/jobs/$job->id")

    // Assert
        ->assertOk()
        ->assertViewIs('jobs.show')
        ->assertViewHasAll(['job']);
});

