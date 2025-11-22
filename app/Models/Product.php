<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Opsional, tapi bagus untuk memastikan

    protected $fillable = [
        'kode_product', // Ganti 'sku' menjadi ini
        'name',
        'description',
        'stock',   
        'price',
        'categori', // Tambahkan ini jika ingin diisi
        'nilai_stock',
    ];
    
    
    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }

    public function checkOuts()
    {
        return $this->hasMany(CheckOut::class);
    }
    

}