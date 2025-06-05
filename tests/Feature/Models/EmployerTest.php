<?php


use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Test that a user can create an employer
it('allows a user to create an employer', function () {
   $user        = User::factory()->create();

   $employer    = new Employer([
       'name'   => 'Acme Inc.',
       'logo'   => 'https://example.com/logo.png'
   ]);
   $employer->user()->associate($user);

   expect($employer)->toBeInstanceOf(Employer::class)
       ->and($employer->user_id)->toBe($user->id)
       ->and($employer->name)->toBe('Acme Inc.')
       ->and($employer->logo)->toBe('https://example.com/logo.png');
});

// Test that a user cannot have more than one employer
it('prevents a user from creating more than one employer', function () {
    $user   = User::factory()->create();

    Employer::factory()->create(['user_id' => $user->id]);

    $this->expectException(QueryException::class);

    // Try to insert another employer with the same user_id
    Employer::factory()->create(['user_id' => $user->id]);
});

// Test employer-user relationship
it('belongs to a user', function () {
    $user       = User::factory()->create();
    $employer   = Employer::factory()->create(['user_id' => $user->id]);

    expect($employer->user)->toBeInstanceOf(User::class)
        ->and($employer->user_id)->toBe($user->id);
});

// Test required fields
it('requires a name and user_id', function () {
    $this->expectException(QueryException::class);

    // Create employer with missing fields
    Employer::create(['user_id' => 5]);
});
