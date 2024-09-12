<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use softdelet
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCandidate extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];
    protected $table = 'job_condidate';
    //belongsTo relations for created_by us er
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    // belongTO relations for id job_apply
    public function jobApply()
    {
        return $this->belongsTo(JobApply::class, 'job_apply_id')->with('Job');
    }
    //belongsTo relations for id Candidate
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
