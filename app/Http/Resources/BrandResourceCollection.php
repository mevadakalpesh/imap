<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Brand;
class BrandResourceCollection extends JsonResource
{
  /**
  * Transform the resource collection into an array.
  *
  * @return array<int|string, mixed>
  */
  public function toArray(Request $request): array
  {
    return [
      "id" => $this->id,
      "image" => $this->image,
      "name" => $this->name,
      "price" => $this->whenNotNull($this->price,""),
      "fields" => new FieldResource($this->fields)
    ];
  }
}