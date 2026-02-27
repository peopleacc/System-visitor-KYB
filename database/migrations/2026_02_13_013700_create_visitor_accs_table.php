<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_accs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('user_meeting')->nullable();

            $table->foreignId('visitor_id')->nullable()->constrained('visitors')->cascadeOnDelete();
            $table->foreignId('contractor_id')->nullable()->constrained('contractors')->nullOnDelete();
            $table->foreignId('supply_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->foreignId('barcode_id')->nullable()->constrained('barcodes')->nullOnDelete();

            $table->date('date');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('visitor_accs');
    }
};
