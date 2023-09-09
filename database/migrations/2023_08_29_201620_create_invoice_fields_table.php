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
        Schema::create('invoice_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('unit_price')->nullable();
            $table->integer('amount')->nullable();
            $table->string('type')->default('Invoice');
            
            $table->foreign('invoice_id')
            ->references('id')
            ->on('invoices')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_fields');
    }
};
