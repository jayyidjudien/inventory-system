<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            // Relasi ke produk
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            // Jumlah barang keluar
            $table->integer('quantity');

            // User yang melakukan check-out
            $table->foreignId('checked_out_by')
                  ->constrained('users')
                  ->nullable()
                  ->onDelete('cascade');

            // Tanggal check-out (opsional, bisa manual input)
            $table->dateTime('check_out_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
