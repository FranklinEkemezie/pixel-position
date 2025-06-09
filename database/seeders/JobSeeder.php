<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        for ($i = 0; $i < fake()->numberBetween(20, 50); $i++) {

            // Create a job
            $job = Job::factory()->create();

            // Tags to attach to the job
            $tags = collect();
            for ($j = 0; $j < fake()->numberBetween(3, 10); $j++) {
                $tag = null;

                if (fake()->boolean(40)) $tag = Tag::factory()->create();
                if (fake()->boolean(60)) $tag = Tag::inRandomOrder()->first();
                if ($tag === null) continue;

                $tags[] = $tag;
            }

            $job->tags()->attach($tags);
        }
    }

}
