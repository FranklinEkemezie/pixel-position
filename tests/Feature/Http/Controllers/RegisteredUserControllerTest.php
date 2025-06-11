<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('displays the user registration page', function () {
    // Arrange

    // Act
    $response = get('/register');

    // Assert
    $response->assertOk();
    $response->assertViewIs('auth.register');
    $response->assertSee([
        'Register', 'name', 'email', 'password',
        'password_confirmation', 'employer_name', 'employer_log'
    ]);
});

it('prevents authenticated user from register page', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $response = get('/register');

    // Assert
    $response->assertRedirect('/dashboard');
});

it('registers a valid user info', function () {
    // Arrange
    $data = [
        'name'      => 'John Doe',
        'email'     => 'john@doe.com',
        'password'  => 'john_doe123',
        'password_confirmation' => 'john_doe123',
        'employer_name'         => 'John Doe & Sons. Ltd.',
        'employer_logo'         => '',
    ];

    // Act
    $response = post('/register', $data);

    // Assert
    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();
});

it('prevents authenticated to access POST /login', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $response = post('/login', []);

    // Assert
    $response->assertRedirect('/dashboard');
});

it('fails to register invalid user details', function () {
    // Arrange
    $data = [];

    // Act
    $response = post('/register', $data);

    // Assert
    $response->assertInvalid(['name', 'email', 'password']);
    assertGuest();
});

it('fails to register invalid employer details', function () {
    // Arrange
    $data = [
        'name'  => 'John Doe',
        'email' => 'john@doe.com',
        'password'  => 'password',
        'password_confirmation' => 'password',

        // missing 'employer name'
    ];

    // Act
    $response = post('/register', $data);

    // Assert
    $response->assertValid(['name', 'email', 'password']);
    $response->assertInvalid(['employer_name']);
    assertGuest();
});
