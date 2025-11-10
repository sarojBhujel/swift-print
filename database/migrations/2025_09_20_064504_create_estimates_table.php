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
            $table->foreignId('client_id')->constrained('customers');
            $table->json('job_ids')->nullable();
            $table->string('item_name');
            $table->string('estimate_no');
            $table->enum('page_color',['b&w','color']);
            $table->integer('pages');
            $table->string('size');
            $table->json('particular_json');
            $table->boolean('is_vat_encluded');
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
