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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('name')->nullable();
            $table->string('paper_id')->nullable();
            $table->string('job_no');
            $table->date('date');
            $table->date('delivery_date')->nullable();
            $table->text('job_description');
            $table->boolean('inner')->default(false);
            $table->boolean('outer')->default(false);
            $table->integer('quantity')->nullable();
            $table->enum('page_type',['bw','cmyk'])->nullable();
            $table->integer('total_plate')->nullable();
            $table->string('size')->nullable();
            $table->integer('total_page')->nullable();
            $table->integer('total_farma')->nullable();
            $table->enum('plate_by',['swift','customer'])->default('swift');
            $table->stirng('plate_from')->nullable();
            $table->string('plate_size')->nullable();
            $table->string('machine')->nullable();
            $table->enum('paper_by',['swift','customer'])->default('swift');
            $table->json('paper_details')->nullable();
            $table->enum('lamination_thermal',['matt','gloss'])->nullable();
            $table->enum('lamination_normal',['matt','gloss'])->nullable();
            $table->boolean('folding')->default(false);
            $table->string('binding')->nullable();
            $table->string('stich')->nullable();
            $table->string('additional')->nullable();
            $table->text('related_to')->nullable();
            $table->text('remarks')->nullable();
            $table->text('special_instruction')->nullable();
            $table->foreignId('prepared_by_id')->nullable()->constrained('users');
            $table->string('prepared_by_name')->nullable();
            $table->string('prepared_by')->nullable();
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
        Schema::dropIfExists('jobs');
    }
};
