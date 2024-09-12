<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use softdelet
use Illuminate\Database\Eloquent\SoftDeletes;
class Candidate extends Model
{
    use HasFactory, SoftDeletes;
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

        return $this->hasMany(JobApply::class, 'candidate_id')->with('Job');
        /**
         * [
         *  [0] => [
         *     'id' => 1,
         *      'candidate_id' => 1,
         *      'job_id' => 1,
         *      'created_at' => '2021-09-01 00:00:00',
         *      'updated_at' => '2021-09-01 00:00:00',
         *      'Job' => [
         *          'id' => 1,
         *          'title' => 'Software Engineer',
         *          'description' => 'Software Engineer',
         *          'created_at' => '2021-09-01 00:00:00',
         *          'updated_at' => '2021-09-01 00:00:00',
         *      ],
         *  ],
         *  [1] => [
         *      'id' => 2,
         *      'candidate_id' => 1,
         *      'job_id' => 2,
         *      'created_at' => '2021-09-01 00:00:00',
         *      'updated_at' => '2021-09-01 00:00:00',
         *      'Job' => [
         *          'id' => 2,
         *          'title' => 'Web Developer',
         *          'description' => 'Web Developer',
         *          'created_at' => '2021-09-01 00:00:00',
         *          'updated_at' => '2021-09-01 00:00:00',
         *      ],
         *  ],
         *  ....etc
         * ]
         * 
         */
    }
    //hasMany relations for jobcandidate
    public function JobCandidates()
    {
        return $this->hasMany(JobCandidate::class, 'candidate_id')->with('jobApply');
        /**
         * [
         *  [0] => [
         *     'id' => 1,
         *     'candidate_id' => 1,
         *      'job_id' => 1,
         *      'created_at' => '2021-09-01 00:00:00',
         *      'updated_at' => '2021-09-01 00:00:00',
         *     'jobApply' => [
         *          'id' => 1,
         *          'candidate_id' => 1,
         *          'job_id' => 1,
         *          'created_at' => '2021-09-01 00:00:00',
         *          'updated_at' => '2021-09-01 00:00:00',
         *  
         *              'Job' => [
         *                  'id' => 1,
         *                  'title' => 'Software Engineer',
         *                  'description' => 'Software Engineer',
         *                  'created_at' => '2021-09-01 00:00:00',
         *                  'updated_at' => '2021-09-01 00:00:00',
         *              ],
         *       ],
        *   ],
         *  [1] => [
         *      'id' => 2,
         *      'candidate_id' => 1,
         *      'job_id' => 2,
         *      'created_at' => '2021-09-01 00:00:00',
         *      'updated_at' => '2021-09-01 00:00:00',
         *      'Job' => [
         *          'id' => 2,
         *          'title' => 'Web Developer',
         *          'description' => 'Web Developer',
         *          'created_at' => '2021-09-01 00:00:00',
         *          'updated_at' => '2021-09-01 00:00:00',
         *      ],
         *  ],
         * ....etc
         */
    }
    //hasMany relations for interview
    public function Interviews()
    {
        return $this->hasMany(Interview::class, 'candidate_id')->with('interviewReview');
    }
}
