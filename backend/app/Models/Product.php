<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['company_id', 'code', 'name', 'category', 'description'];

    // Relasi
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function visitProducts()
    {
        return $this->hasMany(VisitProduct::class);
    }
}