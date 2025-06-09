<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakeSalary = function (): string {
            $fakeAmount     = (fake()->numberBetween(1, 100)) * 1000;
            $fakeCurrency   = fake()->randomElement(['USD', 'EUR', 'NGN', 'JPY', 'AUD', 'CAD', 'GBP']);

            return "$fakeAmount $fakeCurrency";
        };

        $fakeEmployerId = function (): int {
            if (fake()->boolean(60)) {
                // Get from the database
                $employer = Employer::inRandomOrder()->first();
                if ($employer) return $employer->id;
            }

            // Create a new one and return ID
            return Employer::factory()->create()->id;
        };

        return [
            //

            'employer_id'   => $fakeEmployerId(),
            'title'         => fake()->jobTitle(),
            'salary'        => $fakeSalary(),
            'url'           => fake()->url,
            'location'      => fake()->city,
            'schedule'      => fake()->randomElement(['Part-time', 'Full-time']),
            'featured'      => fake()->boolean(20)
        ];
    }
}
