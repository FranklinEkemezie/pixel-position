<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employerLogos = Storage::disk('public')->files('images/employers-logos');
        $getFakeEmployerLogo = fn() => (
            ! empty($employerLogos) ? fake()->randomElement($employerLogos) : fake()->imageUrl
        );

        return [
            //
            'user_id'   => User::factory(),
            'name'      => fake()->unique()->company(),
            'logo'      => $getFakeEmployerLogo()
        ];
    }
}
