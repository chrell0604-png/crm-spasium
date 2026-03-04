<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitCancel extends Model
{
    protected $table = 'visit_cancels';
    protected $fillable = ['visit_id', 'cancel_reason_id', 'notes'];

    // Relasi
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function cancelReason()
    {
        return $this->belongsTo(CancelReason::class);
    }
}