// app/Models/Company.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'name', 
        'code', 
        'description', 
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relasi ke Visitor (bukan Visit)
    public function visitors(): HasMany
    {
        return $this->hasMany(Visitor::class, 'company_id', 'id');
    }

    // Relasi ke Visit
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'company_id', 'id');
    }
}