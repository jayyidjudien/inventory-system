<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $table = 'checkouts';

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'checked_out_by',
        'check_out_date',
        'checked_out_at',
        'returned_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}