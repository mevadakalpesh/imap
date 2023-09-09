<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{

  public function addCar(Request $request) {
    try {
      $validator = Validator::make($request->all(), [
        'vinNumber' => 'required|string|email',
        'carTypeId' => 'required',
        'carSubTypeId' => 'required',
        'engineTypeId' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json([
          "error" => true,
          'message' => $validator->errors()->first(),
          'data' => (object) []
        ]);
      }





    } catch (\Exception $e) {
      return response()->json([
        "error" => true,
        'message' => $e->getMessage(),
        'data' => (object) []
      ]);
    }
  }


}