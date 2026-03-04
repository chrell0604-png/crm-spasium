<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';
    protected $fillable = [
        'company_id', 'visitor_id', 'visit_date', 'purpose', 
        'status', 'type', 'pic_name', 'lead_status', 'notes'
    ];

    // Relasi
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function visitProducts()
    {
        return $this->hasMany(VisitProduct::class);
    }

    public function visitLocations()
    {
        return $this->hasMany(VisitLocation::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function visitCancel()
    {
        return $this->hasOne(VisitCancel::class);
    }
}