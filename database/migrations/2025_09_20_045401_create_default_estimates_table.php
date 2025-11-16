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
        Schema::create('default_estimates', function (Blueprint $table) {
            $table->id();
            $table->string('particular_name');
            $table->decimal('quantity',10,2)->default(1);
            $table->string('unit')->nullable();
            $table->decimal('rate',10,2)->default(0);
            $table->decimal('amount',14,2)->virtualAs('quantity * rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_estimates');
    }
};
