<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          "emergencies" => $this->emergencies,
          "services" => $this->services,
          "parts" => $this->parts,
        ];
    }
    
   public function with(Request $request){
     return [
       "error" => false ,
       "message" => "success"
      ];
   }
   
}
