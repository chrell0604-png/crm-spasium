<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitProduct extends Model
{
    protected $table = 'visit_products';
    protected $fillable = ['visit_id', 'product_id', 'quantity', 'notes'];
}<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitProduct extends Model
{
    protected $table = 'visit_products';
    protected $fillable = ['visit_id', 'product_id', 'quantity', 'notes'];

    // Relasi
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}