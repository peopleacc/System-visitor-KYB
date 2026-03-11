<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('transactions', 'foto')) {
            // Change existing foto column from BLOB to MEDIUMBLOB
            DB::statement('ALTER TABLE transactions MODIFY foto MEDIUMBLOB NULL');
        } else {
            // Add foto column as MEDIUMBLOB if it doesn't exist
            DB::statement('ALTER TABLE transactions ADD COLUMN foto MEDIUMBLOB NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('transactions', 'foto')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn('foto');
            });
        }
    }
};
