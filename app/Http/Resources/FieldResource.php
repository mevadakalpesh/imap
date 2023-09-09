<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
              "id"=> $this->id,
              "type"=> $this->type,
              "selectCar"=> $this->selectCar,
              "pickLocation"=> $this->pickLocation,
              "manufactory"=> $this->manufactory,
              "batteryVoltage"=> $this->batteryVoltage,
              "withService"=> $this->withService,
              "carLicense"=> $this->carLicense,
              "carLicense2"=> $this->carLicense2,
              "withFilter"=> $this->withFilter,
              "pickDate"=> $this->pickDate,
              "startTime"=> $this->startTime,
              "endTime"=> $this->endTime,
              "note"=> $this->note,
              "phone"=> $this->phone,
              "PaymentMethod"=> $this->PaymentMethod,
              "itemId"=> $this->itemId,
          ];
    }
}
