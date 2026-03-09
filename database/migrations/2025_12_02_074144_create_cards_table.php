<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('rfid_code')->nullable()->unique();
            $table->enum('tipe', ['office', 'plant'])->default('office');
            $table->enum('status', ['available', 'booked', 'in_use'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
