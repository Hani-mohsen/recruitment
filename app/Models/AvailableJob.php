<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use softdelet
use Illuminate\Database\Eloquent\SoftDeletes;

class AvailableJob extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'available_jobs';
    protected $guarded = [];

    // belongsTo relations for created_by user
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
