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
        if (Schema::hasTable('estimate_particulars')) {
            Schema::table('estimate_particulars', function (Blueprint $table) {
                // change particular_name from date to string
                // Note: requires doctrine/dbal to change existing column types
                if (Schema::hasColumn('estimate_particulars', 'particular_name')) {
                    $table->string('particular_name')->change();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('estimate_particulars')) {
            Schema::table('estimate_particulars', function (Blueprint $table) {
                if (Schema::hasColumn('estimate_particulars', 'particular_name')) {
                    $table->date('particular_name')->change();
                }
            });
        }
    }
};
