<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAppliesTable extends Migration
{
    public function up()
    {
        Schema::create('job_applies', function (Blueprint $table) {

            $table->id();
            $table->foreignId('available_job_id')->constrained('available_jobs');
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applies');
    }
}
