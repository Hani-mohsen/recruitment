<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobApply;

class JobApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // generate 10 records for model Candidate
      //  $candidates = Candidate::factory(10)->create();
        $faker = \Faker\Factory::create();

        
        // Insert fake data into the database
        for ($i = 0; $i < 10; $i++) {
            JobApply::create([
                'available_job_id' => $faker->numberBetween(1, 10),
                'candidate_id' => $faker->numberBetween(1, 10),
                

                /*
                  $table->foreignId('available_job_id')->constrained('available_jobs');
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->timestamps();
                 */
            ]);
        }
    }
}
