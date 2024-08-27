<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;

    protected $guarded = [];

    // belongsTo relations for candidate_id Candidate
    public function createdBy()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    //belongTO relations for id AvailableJob
    public function availableJob()
    {
        return $this->belongsTo(AvailableJob::class, 'available_job_id');
    }
    //hasMany relations for jobcandidate
    public function jobCandidate()
    {
        return $this->hasMany(JobCandidate::class, 'job_apply_id');
    }

}
