<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $fillable = [
        'visit_id', 'activity_number', 'tag', 'notes', 
        'result', 'activity_date', 'duration'
    ];

    // Relasi
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}