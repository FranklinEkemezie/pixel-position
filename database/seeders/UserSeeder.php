<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        for ($i = 0; $i < fake()->numberBetween(5, 10); $i++) {
            $user = User::factory()->create();
            Employer::factory()->create(['user_id' => $user->id]);
        }
    }
}
