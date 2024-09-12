<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use softdelet
use Illuminate\Database\Eloquent\SoftDeletes;
class Interview extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // belongsTo relations for created_by user
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // belongsTo relations for job_apply_id job_apply
    public function jobApply()
    {
        return $this->belongsTo(JobApply::class, 'job_apply_id')->with('Job');
    }

    // belongsTo relations for candidate_id Candidate
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    // hasMany relations for interviewReview
    public function interviewReview()
    {
        return $this->hasMany(InterviewReview::class, 'interview_id');
    }

}
