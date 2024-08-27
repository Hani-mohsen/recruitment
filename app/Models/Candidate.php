<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $table = 'candidates';
    protected $fillable = [
        'FistName',
        'LastName',
        'Email',
        'Phone',
        'City',
        'profile',
        'Resume',
    ];
    protected $guarded = [];

    // hasMany relations for JobApply
    public function JobApplies()
    {
        return $this->hasMany(JobApply::class, 'candidate_id');
    }
    //hasMany relations for jobcandidate
    public function JobCandidates()
    {
        return $this->hasMany(JobCandidate::class, 'candidate_id');
    }
    //hasMany relations for interview
    public function Interviews()
    {
        return $this->hasMany(Interview::class, 'candidate_id');
    }
}
