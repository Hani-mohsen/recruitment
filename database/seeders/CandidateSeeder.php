<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Candidate;

class CandidateSeeder extends Seeder
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
        for ($i = 10; $i < 1000; $i++) {
            Candidate::create([
                'FirstName' => $faker->firstName,
                'LastName' => $faker->lastName,
                // Email should be uniqe
                'Email' => $faker->unique()->safeEmail,
                
                'Phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'profile' => $faker->imageUrl(),
                'Resume' => ($faker->text . '.pdf'),

                /*
                $table->string('FirstName');
                $table->string('LastName');

                $table->string('Email',100)->unique();
                $table->string('Phone');
                $table->string('city')->nullable();
                $table->string('profile')->nullable();
                $table->text('Resume')->nullable();
                 */
            ]);
        }
    }
}
