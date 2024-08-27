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
        Schema::create('available_jobs', function (Blueprint $table) {

            $table->id('id');
            
            $table->string('JobTitle');
            $table->text('JobDescription');
            $table->foreignId('created_by')->constrained('users');
            $table->decimal('SalaryRange', 8, 2)->nullable();
            $table->date('PostingDate');
            $table->date('ClosingDate');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_jobs');
    }
};
