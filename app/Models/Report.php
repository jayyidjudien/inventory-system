<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Report extends Model
{
     use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity_checked_in',
        'quantity_checked_out',
        'current_stock',
        'date',
    ];

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
