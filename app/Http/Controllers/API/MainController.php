<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Car;
use App\Models\CarType;
use App\Models\EngineType;
use App\Models\Part;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\HomeResource;
use App\Http\Resources\BrandResourceCollection;


class MainController extends Controller
{

  public $lang = 'en';


  public function home(Request $request) {

    $acceptLng = 'en';
    if ($request->header('Accept-Language') == 'ar') {
      $acceptLng = 'ar';
    }
    $this->lang = $acceptLng;

    $data = [];
    $data['emergencies'] = BrandResourceCollection::collection($this->getEmergencies());
   // $data['emergencies'] = $this->getEmergencies();
    $data['services'] = $this->getService();
    $data['parts'] = $this->getParts();
    
    return new HomeResource((object) $data);

  }

  public function getEmergencies() {
    $lang = $this->lang;
    $brand = Brand::selectRaw("
      brands.*,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ")->with(['fields'])->where('type', 1)->get();


    // $staticBrandCategories  = $this->staticBrandCategories();
    //$staticServiceCategories = $this->staticServiceCategories();
    //$brand->each(function($value) use ($staticBrandCategories,$staticServiceCategories){
    //$value->brandCategories =$staticBrandCategories;
    //$value->serviceCategories =$staticServiceCategories;
    // $value->fields->type ='Emergency';
    // });

    return $brand;
  }

  public function getService() {
    $lang = $this->lang;
    $with = [
      'serviceCategories' => function ($query) use ($lang) {
        return $query->selectRaw("
        brands.id,
        brands.price,
        brands.image,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ");
      },
      'serviceCategories.fields'
    ];
    $service = Service::selectRaw("
        services.image,
        services.id,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ")->with($with)->get();
    return $service;
  }

  public function getParts() {
    $lang = $this->lang;
    $with = [
      'brandCategories' => function ($query) use ($lang) {
        return $query->selectRaw("
         brand_categories.*,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ");
      },
      'brandCategories.brands' => function ($query) use ($lang) {
        return $query->selectRaw("
         brands.*,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ");
      },
      'brandCategories.brands.fields'
    ];
    $service = Part::selectRaw("
        parts.*,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ")->with($with)->get();
    return $service;
  }


  public function editProfile(Request $request) {
    return response()->json([
      "error" => false,
      'message' => 'In Process ',
      'data' => []
    ]);
  }

  public function terms(Request $request) {

    $data = AboutUs::where('type','Term')->first();
    return response()->json([
      "error" => false,
      'message' => 'Success',
      'data' => $data
    ]);
  }

  public function addCar(Request $request) {

    try {

      $validator = Validator::make($request->all(), [
        'vinNumber' => 'required',
        'carTypeId' => 'required',
        'carSubTypeId' => 'required',
        'engineTypeId' => 'required',
        'authId' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json([
          "error" => true,
          'message' => $validator->errors()->first(),
          'data' => (object) []
        ]);
      }
      $data = [
        'vinNumber' => $request->vinNumber,
        'carTypeId' => $request->carTypeId,
        'carSubTypeId' => $request->carSubTypeId,
        'engineTypeId' => $request->engineTypeId,
        'user_id' => $request->authId,
      ];
      $userCar = Car::create($data);

      return response()->json([
        "error" => false,
        'message' => 'Success',
        'data' => []
      ]);


    } catch (\Exception $e) {
      return response()->json([
        "error" => true,
        'message' => $e->getMessage(),
        'data' => (object) []
      ]);
    }
  }


  public function getUserCar(Request $request, $authId) {
    $lang = 'en';
    if ($request->header('Accept-Language') == 'ar') {
      $lang = 'ar';
    }
    $with = [
      'carType' => function ($query) use ($lang) {
        return $query->selectRaw("
            car_types.*,
            CASE
                WHEN '$lang' = 'ar' THEN ar_name
                ELSE en_name
            END AS typeName,
            car_types.image as typeImage
        ");
      },
      'carSubType' => function ($query) use ($lang) {
        return $query->selectRaw("
            car_types.*,
            CASE
                WHEN '$lang' = 'ar' THEN ar_name
                ELSE en_name
            END AS subTypeName
        ");
      },
      'engineType' => function ($query) use ($lang) {
        return $query->selectRaw("
            engine_types.*,
            CASE
                WHEN '$lang' = 'ar' THEN ar_name
                ELSE en_name
            END AS engineTypeName
        ");
      }];

    $userData = Car::where('user_id', $authId)->where('active_status', 'Approved')->with($with)->get();

    $requestData = [];
    if (!blank($userData)) {
      foreach ($userData as $data) {
        $item = [
          "id" => $data->id,
          "carName" => $data->carType->typeName ?? null,
          "vinNumber" => $data->vinNumber,
          "color" => $data->color,
          "lastOilChangeDate" => $data->lastOilChangeDate,
          "registrationNumber" => $data->registrationNumber,
          "yearOfProduction" => $data->yearOfProduction,
          "enginePower" => $data->enginePower,
          "carTypeId" => $data->carTypeId,
          "carSubTypeId" => $data->carSubTypeId,
          "engineTypeId" => $data->engineTypeId,
          "typeName" => $data->carType->typeName ?? null,
          "typeImage" => $data->carType->image ?? null,
          "subTypename" => $data->carSubType->subTypeName ?? null,
          "engineTypeName" => $data->engineType->engineTypeName ?? null,
          "report" => (object)[]
        ];
        $requestData[] = $item;
      }
    }

    return response()->json([
      "error" => false,
      'message' => 'Success',
      'data' => $requestData
    ]);
  }

  public function getEngineTypes(Request $request) {
    $lang = 'en';
    if ($request->header('Accept-Language') == 'ar') {
      $lang = 'ar';
    }
    $data = EngineType::selectRaw("
      engine_types.id,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ")->get();
    return response()->json([
      "error" => false,
      'message' => 'Success',
      'data' => $data
    ]);
  }


  public function getAboutUs(Request $request) {
    $data = AboutUs::where('type','AboutUs')->first();
    return response()->json([
      "error" => false,
      'message' => 'Success',
      'data' => $data
    ]);
  }


  public function getCarTypes(Request $request) {
    $lang = 'en';
    if ($request->header('Accept-Language') == 'ar') {
      $lang = 'ar';
    }
    $with = [
      'carSubType' => function ($query) use ($lang) {
        return $query->selectRaw("
        car_types.id,
        car_types.image,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ");
      }];

    $data = CarType::selectRaw("
      car_types.id,
      car_types.image,
          CASE
              WHEN '$lang' = 'ar' THEN ar_name
              ELSE en_name
          END AS name
      ")->with($with)->where('type', 'Car')->get();

    return response()->json([
      "error" => false,
      'message' => 'Success',
      'data' => $data
    ]);
  }

}