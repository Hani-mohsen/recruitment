<?php

namespace Database\Seeders;

use App\Models\AvailableJob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Use Hash 
use Illuminate\Support\Facades\Hash;
// Use Str
use Illuminate\Support\Str;

class AvalibleJobSeeder extends Seeder
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

            AvailableJob::create([
              
                'JobTitle' => $faker->jobTitle,
                'JobDescription' => $faker->text,
                'created_by' => 1,
                'SalaryRange' => $faker->randomFloat(2, 1000, 5000),
                'PostingDate' => $faker->date(),
                'ClosingDate' => $faker->date(),
                /*
             $table->string('JobTitle');
            $table->text('JobDescription');
            $table->foreignId('created_by')->constrained('users');
            $table->decimal('SalaryRange', 8, 2)->nullable();
            $table->date('PostingDate');
            $table->date('ClosingDate');
            $table->timestamps();
                 */
            ]);
        }
    }
}
