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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('user_meeting')->nullable();

            $table->foreignId('visitor_id')->nullable()->constrained('visitors')->cascadeOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->foreignId('card_id')->nullable()->constrained('cards')->nullOnDelete();

            $table->date('date');
            $table->string('dept')->nullable();
            $table->string('status')->nullable();
            $table->string('barcode')->nullable();

            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();

            $table->string('purpose')->nullable();
            $table->string('type')->nullable();

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
