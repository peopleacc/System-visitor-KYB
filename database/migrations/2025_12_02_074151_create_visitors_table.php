<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('email');
            $table->string('full_name');
            $table->string('institution')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('no_kendaraan', 255)->nullable();
            $table->string('yang_ditemui')->nullable();
            $table->string('urusan')->nullable();
            $table->unsignedInteger('jumlah')->nullable();
            $table->time('jam_pertemuan')->nullable();
            $table->timestamp('check_in_at')->nullable();
            $table->timestamp('check_out_at')->nullable();
            $table->string('batch')->nullable();
            $table->timestamps();

        });

        // Add foreign key from cards.active_visitor_id -> visitors.id
        // Schema::table('cards', function (Blueprint $table) {
        //     $table->foreign('active_visitor_id')
        //         ->references('id')->on('visitors')
        //         ->nullOnDelete();
        // });
    }

    public function down(): void
    {
        // Schema::table('cards', function (Blueprint $table) {
        //     $table->dropForeign(['active_visitor_id']);
        // });

        Schema::dropIfExists('visitors');
    }
};
