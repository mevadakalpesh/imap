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
    Schema::create('fields', function (Blueprint $table) {
        $table->id();
        $table->string('type')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('selectCar')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('pickLocation')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('manufactory')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('batteryVoltage')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('withService')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('carLicense')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('carLicense2')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('withFilter')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('pickDate')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('startTime')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('endTime')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('note')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('phone')->default(0)->comment('0 = deactive & 1 active');
        $table->tinyInteger('PaymentMethod')->default(0)->comment('0 = deactive & 1 active');
        $table->unsignedBigInteger('itemId');
        $table->timestamps();
      });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
      Schema::dropIfExists('fields');
    }
  };