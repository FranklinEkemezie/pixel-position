<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('shows the login page' , function () {
    // Arrange

    // Act
    $response = get('/login');

    // Assert
    $response->assertOk();
    $response->assertViewIs('auth.login');
    $response->assertSee([
        'Login', 'email', 'password'
    ]);
});

it('prevents authenticated user from login page', function () {
    // Arrange
    actingAs(User::factory()->create());

    // Act
    get('/register')

    // Assert
        ->assertRedirect('/dashboard');
});

it('logins in valid credentials', function () {

    // Arrange
    User::factory()->create([
        'email'     => 'test@example.com',
        'password'  => 'password'
    ]);
    $data = [
        'email'     => 'test@example.com',
        'password'  => 'password'
    ];

    // Act
    post('/login', $data)

    // Assert
        ->assertRedirect('/dashboard');
    assertAuthenticated();
});

it('fails to login invalid credentials', function () {
    // Arrange

    // Act
    post('/login', [])

    // Assert
        ->assertInvalid(['email', 'password']);
    assertGuest();
});

it('clears logged in authentication session', function () {
    // Arrange
    actingAs(User::factory()->create());

    // Act
    delete('/logout')

    // Assert
        ->assertRedirect('/');
    assertGuest();
});

it('prevents unauthenticated user from accessing logout route', function () {
    // Arrange

    // Act
    delete('/logout')

    // Assert
        ->assertRedirect('/register');
});
