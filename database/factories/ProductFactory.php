<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $harga = $this->faker->numberBetween(1000, 50000);
        $stok  = $this->faker->numberBetween(1, 500);

        return [
            'kode_product' => 'PRD' . str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'name'         => $this->faker->words(3, true),
            'categori'     => $this->faker->randomElement(['Makanan','Minuman','Alat Tulis','Elektronik']),
            'price'        => $harga,
            'stock'         => $stok,
            'nilai_stock'   => $harga * $stok,
            'aksi'         => 'in stock',
        ];
    }
}