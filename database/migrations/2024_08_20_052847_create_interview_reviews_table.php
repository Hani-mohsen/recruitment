<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('interview_reviews', function (Blueprint $table) {

            $table->id();
            $table->foreignId('interview_id')->constrained('interviews');
            $table->foreignId('created_by')->constrained('users');
            $table->text('review');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interview_reviews');
    }
}
