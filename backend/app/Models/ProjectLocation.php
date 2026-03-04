<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    protected $table = 'project_locations';
    protected $fillable = ['company_id', 'name'];

    // Relasi
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function visitLocations()
    {
        return $this->hasMany(VisitLocation::class);
    }
}