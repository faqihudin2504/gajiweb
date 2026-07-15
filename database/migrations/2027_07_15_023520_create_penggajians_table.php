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
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            // Foreign key yang menyambung ke tabel karyawans
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade'); 
            $table->integer('gaji_pokok');
            $table->integer('tunjangan')->default(0);
            $table->integer('total_gaji')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
