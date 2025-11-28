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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->json('job_ids');
            $table->foreignId('client_id')->constrained('customers');
            $table->string('estimate_no')->nullable();
            $table->date('date')->nullable();
            $table->string('paper')->nullable();
            $table->string('color')->nullable();
            $table->string('total_page')->nullable();
            $table->string('size')->nullable();
            $table->boolean('is_vat_included')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
