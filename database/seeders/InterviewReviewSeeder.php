<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InterviewReview;

class InterviewReviewSeeder extends Seeder
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
            InterviewReview::create([
                'interview_id' => $faker->numberBetween(1, 10),
                'created_by' => $faker->numberBetween(1, 10),
                'review' => $faker->text,
                'rating' => $faker->numberBetween(1, 5),


                /*
               $table->foreignId('interview_id')->constrained('interviews');
            $table->foreignId('created_by')->constrained('users');
            $table->text('review');
            $table->integer('rating');
            $table->timestamps();
                 */
            ]);
        }
    }
}
