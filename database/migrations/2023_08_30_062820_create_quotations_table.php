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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_to')->nullable();
            $table->string('quotation_attn')->nullable();
            $table->string('quotation_title')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('your_ref')->nullable();
            $table->dateTime('quotation_date')->nullable();
            $table->string('quotation_from')->nullable();
            $table->string('fax')->nullable();
            $table->string('subject')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('sub_total_qar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
