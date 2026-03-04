<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitLocation extends Model
{
    protected $table = 'visit_locations';
    protected $fillable = ['visit_id', 'project_location_id', 'notes'];

    // Relasi
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function projectLocation()
    {
        return $this->belongsTo(ProjectLocation::class);
    }
}