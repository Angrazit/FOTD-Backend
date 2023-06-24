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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('style_id');
            $table->enum('catagory', ['baju','celana','aksesoris','alas kaki'])->default('baju');
            $table->text('link_gambar');
            $table->text('link_toko');
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreign('style_id')->references('style_id')->on('styles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
