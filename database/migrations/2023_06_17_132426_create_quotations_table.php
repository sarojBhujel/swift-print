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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('job_name');
            $table->string('paper')->nullable();
            $table->string('quotation_no')->nullable();
            $table->string('print')->nullable();
            $table->string('quantity')->nullable();
            $table->string('page')->nullable();
            $table->string('size')->nullable();
            $table->string('lamination')->nullable();
            $table->string('binding')->nullable();
            $table->string('rate')->nullable();
            $table->string('quotation')->nullable();
            $table->string('date')->nullable();
            $table->text('note')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('quotations');
    }
};
