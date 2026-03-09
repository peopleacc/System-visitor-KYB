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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('visitor_id')->nullable()->constrained('visitors')->cascadeOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete();
            $table->foreignId('barcode_id')->nullable()->constrained('barcodes')->nullOnDelete();


            $table->date('date');
            $table->string('status')->nullable();
            $table->string('QRcode')->nullable();
            $table->string('barcode')->nullable();

            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();

            $table->string('purpose')->nullable();
            $table->string('type')->nullable();
            $table->string('signature_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
