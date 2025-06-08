<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\EmployerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed some users
        User::factory(10)->create();

        // Seed some employers
        Employer::factory(20)->create();

        // Seed some tags
        $tags = Tag::factory(30)->create();

        // Seed some jobs
        Job::factory(50)
            ->create()
            ->each(fn($job) => $job->tags()->attach(
                $tags->random(rand(3, 10))->pluck('id')->toArray()
            ));

    }
}
