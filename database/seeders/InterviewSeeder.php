<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interview;

class InterviewSeeder extends Seeder
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
            Interview::create([
                'job_apply_id' => $faker->numberBetween(1, 10),
                'candidate_id' => $faker->numberBetween(1, 10),
                'created_by' => $faker->numberBetween(1, 10),
                'interview_date'=> $faker->date($format = 'Y-m-d', $max = 'now'),
                'status' => $faker->word,
                'intervwer' => $faker->word,
                

                /*
                $table->foreignId('job_apply_id')->constrained('job_applies');
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->foreignId('created_by')->constrained('users');

            $table->dateTime('interview_date');
            $table->string('status');
            $table->string('intervwer');

            $table->timestamps();
                 */
            ]);
        }
    }
}
