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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('vinNumber');
            $table->string('color')->default("");
            $table->string('lastOilChangeDate')->default("");
            $table->string('registrationNumber')->default("");
            $table->string('yearOfProduction')->default("");
            $table->string('enginePower')->default("");
            $table->unsignedBigInteger('carTypeId');
            $table->unsignedBigInteger('engineTypeId');
            $table->unsignedBigInteger('carSubTypeId');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('active_status')->default('Disapproved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
