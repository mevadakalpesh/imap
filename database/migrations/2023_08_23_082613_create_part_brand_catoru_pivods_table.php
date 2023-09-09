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
        Schema::create('part_brand_catoru_pivods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('brand_category_id');
            
            $table->foreign('brand_category_id')
            ->references('id')
            ->on('brand_categories')
            ->onDelete('cascade');
            
            $table->foreign('part_id')
            ->references('id')
            ->on('parts')
            ->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_brand_catoru_pivods');
    }
};
