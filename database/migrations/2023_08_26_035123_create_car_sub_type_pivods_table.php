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
    Schema::create('car_sub_type_pivods', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('car_type_id');
      $table->unsignedBigInteger('car_sub_type_id');

    });
  }

  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('car_sub_type_pivods');
  }
};