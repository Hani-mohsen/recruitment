<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {

            $table->id();
            $table->foreignId('job_apply_id')->constrained('job_applies');
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->foreignId('created_by')->constrained('users');

            $table->dateTime('interview_date');
            $table->string('status');
            $table->string('intervwer');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interviews');
    }
}
