<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Use Hash 
use Illuminate\Support\Facades\Hash;
// Use Str
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
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

            $randomPassword = Str::random(6);
            User::create([
                'name' => $faker->name, 
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make($randomPassword),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'note' => $randomPassword,
                /*
                $table->string('name');
                $table->string('email',100)->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                 */
            ]);
        }
    }
}
