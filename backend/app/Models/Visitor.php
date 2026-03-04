<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $fillable = [
        'company_id', 'name', 'phone', 'email', 
        'company_name', 'source', 'address', 'notes'
    ];

    // Relasi
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}