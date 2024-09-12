<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use softdelet
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApply extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // belongsTo relations for candidate_id Candidate
    public function createdBy()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    //belongTO relations for id AvailableJob
    public function Job()
    {
        return $this->belongsTo(AvailableJob::class, 'available_job_id')->with('createdBy');
    }
    //hasMany relations for jobcandidate
  

}
