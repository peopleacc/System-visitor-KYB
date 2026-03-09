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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            // tanggal kerja
            $table->date('tanggal');

            // data perusahaan
            $table->string('nama_pt');
            $table->string('nama_pekerjaan');
            $table->string('area_pekerjaan');
            $table->string('email');
            $table->string('tanggal_masuk');

            // user / pic
            $table->string('pic')->nullable();

            // manpower
            $table->integer('jumlah_mp')->default(0);

            // safety officer
            $table->string('safety_officer_nama')->nullable();
            $table->string('safety_officer_hp')->nullable();


            $table->timestamps();

        });
        // Add foreign key from cards.active_vendors_id -> vendors.id
        // Schema::table('cards', function (Blueprint $table) {
        //     $table->foreign('active_vendors_id')
        //         ->references('id')->on('vendors')
        //         ->nullOnDelete();
        // });
    }

    public function down(): void
    {
        // Schema::table('cards', function (Blueprint $table) {
        //     $table->dropForeign(['active_visitor_id']);
        // });

        Schema::dropIfExists('vendors');
    }
};
