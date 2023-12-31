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
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->string('color')->default('white');
            $table->enum('gender',['male', 'female'])->default('male');
            $table->enum('category',['Casual', 'Formal','Street Style', 'Vintage Style','Islamic Style'])->default('Casual');
            $table->text('gambar_path')->nullable();
            $table->text('gambar_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('styles');
    }
};
