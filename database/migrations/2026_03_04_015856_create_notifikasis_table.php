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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('user_meeting');
            $table->foreignId('visitor_id')
                ->constrained('visitors')           // ← sebutkan nama tabel secara eksplisit
                ->cascadeOnUpdate()
                ->onDelete('cascade')
                ->nullable();
            $table->foreignId('vendor_id')
                ->constrained('vendors')           // ← sebutkan nama tabel secara eksplisit
                ->cascadeOnUpdate()
                ->onDelete('cascade')
                ->nullable();
            $table->string('no_hp');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
