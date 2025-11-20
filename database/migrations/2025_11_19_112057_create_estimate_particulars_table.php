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
        Schema::create('estimate_particulars', function (Blueprint $table) {
            $table->id();
            $table->date('particular_name');
            $table->foreignId('estimate_id')->nullable()->constrained('estimates');
            $table->foreignId('default_estimate_particular_id')->nullable()->constrained('default_estimates');
            $table->decimal('quantity', 10, 2)->default(1);
            $table->string('unit')->nullable();
            $table->decimal('rate', 10, 2)->default(0);
            $table->decimal('amount', 14, 2)->virtualAs('quantity * rate')->nullable();
            $table->string('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimate_particulars');
    }
};
