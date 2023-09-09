<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\EmergencieCollection;
use App\Models\User;
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
      "error" => false,
      'message' => 'Success',
      'data' => [
        'emergencies' => EmergencieCollection::collection($this->emergencies),
        'services' => $this->services,
        'parts' => $this->parts,
      ]
    ];
  }

}