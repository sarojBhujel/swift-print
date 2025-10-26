<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('paper_id');
            $table->string('bill_no');
            $table->string('date');
            $table->string('supplier');
            $table->string('quantity');
            $table->string('type');
            $table->string('balance');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paper_stocks');
    }
};
