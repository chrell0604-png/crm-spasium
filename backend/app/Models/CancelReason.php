<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelReason extends Model
{
    protected $table = 'cancel_reasons';
    protected $fillable = ['company_id', 'reason'];

    // Relasi
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function visitCancels()
    {
        return $this->hasMany(VisitCancel::class);
    }
}