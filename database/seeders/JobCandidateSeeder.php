<?php

namespace Database\Seeders;

use App\Models\JobCandidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InterviewReview;

class JobCandidateSeeder extends Seeder
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
            JobCandidate::create([
                'created_by' => $faker->numberBetween(1, 10),
                'candidate_id' => $faker->numberBetween(1, 10),
                'job_apply_id' => $faker->numberBetween(1, 10),


                /*
              $table->foreignId('created_by')->constrained('users');
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->foreignId('job_apply_id')->constrained('job_applies');

            $table->timestamps();
                 */
            ]);
        }
    }
}
