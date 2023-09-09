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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('price',10,2);
            $table->string('lat');
            $table->string('long');
            $table->string('status');
            $table->string('manufactory');
            $table->string('carLicense');
            $table->string('carLicense2')->nullable();
            $table->tinyInteger('withService')->default(1);
            $table->tinyInteger('withFilter')->default(1);
            $table->dateTime('startTime');
            $table->dateTime('endTime')->nullable();
            $table->dateTime('pickDate')->nullable();
            $table->string('PaymentMethod')->default('COD');
            $table->string('note')->nullable();
            $table->string('type');
            $table->string('batteryVoltageId')->nullable();
            $table->string('phone')->nullable();
           
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('carId');
            $table->unsignedBigInteger('itemId');
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
