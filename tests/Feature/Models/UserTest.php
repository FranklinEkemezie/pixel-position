 <?php

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Instantiation
 */

it('requires a name, email and password', function () {
    $this->expectException(QueryException::class);

    // Create user with missing fields
    User::create([]);
});

/**
 * Abilities
 */

it('can create an employer', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $employer = Employer::factory()->for($user)->create();

    // Assert
    expect($employer)->toBeInstanceOf(Employer::class)
        ->and($employer->user_id)->toBe($user->id);
});

/**
 * Constraints
 */

it('can only create one employer', function () {
    // Arrange
    $user = User::factory()->create();

    // Act and Assert
    $this->expectException(QueryException::class);
    Employer::factory(10)->for($user)->create();
});

/**
 * Relationships
 */

it('has one employer', function () {
    // Arrange
    $user = User::factory()->create();

    // Act and Assert
    expect($user->employer())->toBeInstanceOf(HasOne::class);
});
