<?php

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Test required fields
it('requires a title, employer ID, salary, and url', function () {
    $this->expectException(QueryException::class);

    // Create job with missing fields
    Job::create([]);
});

// Test that an employer can create job
it('allows an employer to create a job', function () {
    $employer = Employer::factory()->create();

    $job = new Job([
        'title'     => 'Shift Leader',
        'salary'    => '$50,000',
        'url'       => 'https://www.example.com/job/122332'
    ]);
    $job->employer()->associate($employer);

    expect($job)->toBeInstanceOf(Job::class)
        ->and($job->employer_id)->toBe($employer->id)
        ->and($job->title)->toBe('Shift Leader')
        ->and($job->salary)->toBe('$50,000')
        ->and($job->url)->toBe('https://www.example.com/job/122332');
});

// Test that an employer can have many jobs
it('allows an employer to create more than one job', function () {
    $employer = Employer::factory()->create();

    $jobs = Job::factory(10)->create(['employer_id' => $employer->id]);

    expect($employer->jobs->pluck('id')->sort()->values())
        ->toEqual($jobs->pluck('id')->sort()->values());
});

// Test job-employer relationship
it('belongs to an employer', function () {
    $employer = Employer::factory()->create();

    $job = Job::factory()->create(['employer_id' => $employer->id]);

    expect($job->employer)->toBeInstanceOf(Employer::class)
        ->and($job->employer_id)->toBe($employer->id);
});
