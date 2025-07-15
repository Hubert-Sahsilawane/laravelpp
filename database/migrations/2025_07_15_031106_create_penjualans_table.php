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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('penjualanID');
            $table->date('tanggalPenjualan');
            $table->decimal('totalPenjualan', 10, 2);
            $table->unsignedBigInteger('pelangganID');
            $table->timestamps();

            //Foreign key
            $table->foreign('pelangganID')
                ->references('pelangganID')
                ->on('pelanggan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
