<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableJob extends Model
{
    use HasFactory;

    protected $guarded = [];

    // belongsTo relations for created_by user
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
