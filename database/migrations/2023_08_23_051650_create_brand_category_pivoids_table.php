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
        Schema::create('brand_category_pivoids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_category_id');
            $table->unsignedBigInteger('brand_id');
            
            $table->foreign('brand_category_id')
            ->references('id')
            ->on('brand_categories')
            ->onDelete('cascade');
            
            $table->foreign('brand_id')
            ->references('id')
            ->on('brands')
            ->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_category_pivoids');
    }
};
