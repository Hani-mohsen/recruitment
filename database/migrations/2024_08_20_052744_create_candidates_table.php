<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {

            $table->id('id');
            $table->string('FirstName');
            $table->string('LastName');

            $table->string('Email',100)->unique();
            $table->string('Phone');
            $table->string('city')->nullable();
            $table->string('profile')->nullable();
            $table->text('Resume')->nullable();
          
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
