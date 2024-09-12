<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
// use softdelet
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use   HasFactory, Notifiable,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //hasMany relations for availableJob
    public function availableJobs()
    {
        return $this->hasMany(AvailableJob::class, 'created_by');
    }
    //hasMany relations for InterviewReview
    public function interviewReviews()
    {
        return $this->hasMany(InterviewReview::class, 'created_by');
    }
    //hasMany relations for InterviewReview
    public function interviews()
    {
        return $this->hasMany(Interview::class, 'created_by');
    }
    public function jobcondidates()
    {
        return $this->hasMany(JobCandidate::class, 'created_by');
    }

}  
