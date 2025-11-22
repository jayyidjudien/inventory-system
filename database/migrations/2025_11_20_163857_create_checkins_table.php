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
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
              $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            // Jumlah barang masuk
            $table->integer('quantity');

            // User yang melakukan check-in
            $table->foreignId('checked_in_by')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Tanggal check-in (opsional, bisa manual input)
            $table->dateTime('check_in_date')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkins');
    }
};
