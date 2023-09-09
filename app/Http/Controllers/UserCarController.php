<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarType;
use App\Models\EngineType;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UserCarController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {

     
     //dd($data->toArray());
  if ($request->ajax()) {
      $with = ['user','carType','carSubType','engineType'];
      $data = Car::with($with)
      ->has('user')
      ->has('carType')
      ->has('carSubType')
      ->has('engineType')
      ->get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function($row) {
        $status = '';
        $class = '';
        if($row->active_status == "Disapproved" ){
          $status = "Approved";
          $class = 'success';
        }else {
          $status = "Disapproved";
          $class = 'danger';
        }
        
        $btn = '<a href="'.route('user-car.edit', $row->id).'" data-user-carid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-user-carid="'.$row->id.'" class="btn delete-user-car btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
        <button type="button" data-user-carid="'.$row->id.'" data-changeStatus="'.$status.'" class="btn change-user-car btn-'.$class.' btn-sm"> '.$status.' </button>';
        
        return $btn;
      })
      ->editColumn('user_name', function(Car $brand) {
        return $brand->user->name;
      })
      ->editColumn('carName', function(Car $brand) {
        return $brand->carType->en_name;
      })
      ->editColumn('typeImage', function(Car $brand) {
        return '<img src="'.$brand->carType->image.'" width="100px" height="100px" />';
      })
      ->editColumn('subTypename', function(Car $brand) {
        return $brand->carSubType->en_name;
      })
      ->editColumn('engineTypeName', function(Car $brand) {
        return $brand->engineType->en_name;
      })
      ->rawColumns([
        'typeImage',
        'action'
        ])
      ->make(true);
    }

    return view('user-car.user-car-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {}

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {}

  /**
  * Display the specified resource.
  */
  public function show(string $id) {
    //
  }

  /**
  * Show the form for editing the specified resource.
  */
  public function edit(string $id) {
    $with = ['user','carType','carSubType','engineType'];
    $theCar = Car::with($with)->find($id);
    $carType = CarType::with(['carSubType'])->where('type','Car')->get();
    $engineType = EngineType::get();
    
    return view('user-car.user-car-edit', [
      'theCar' => $theCar,
      'carType' => $carType,
      'engineType' => $engineType,
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {

    $request->validate([
      'car' => 'required',
      'car_sub' => 'required',
      'engineTypeId' => 'required'
    ]);
    try {
      
      $data = [
        "carTypeId" => $request->car ,
        "carSubTypeId" => $request->car_sub,
        "vinNumber" => $request->vinNumber,
        "color" => isset($request->color) && !empty($request->color) ? $request->color : "",
        "lastOilChangeDate" => isset($request->lastOilChangeDate) && !empty($request->lastOilChangeDate) ? $request->lastOilChangeDate : "",
        "registrationNumber" => isset($request->registrationNumber) && !empty($request->registrationNumber) ? $request->registrationNumber : "",
        "yearOfProduction" => isset($request->yearOfProduction) && !empty($request->yearOfProduction) ? $request->yearOfProduction : "",
        "enginePower" => isset($request->enginePower) && !empty($request->enginePower) ? $request->enginePower : "",
        "engineTypeId" => $request->engineTypeId,
        "active_status" => $request->active_status,
      ];
      
      Car::where('id',$id)->update($data);
      
      session()->flash('success', 'User Car Update SucesaFully');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('user-car.index');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    $category = Car::where('id', $id)->delete();
    return response()->json(['status' => 200, 'msg' => 'Success']);
  }
  
  public function getSubCarById(Request $request){
  
   $parentId =  $request->parentId;
   $subSelectedId =  $request->subSelectedId;
   $html ="<option value=''>Select Sub Car </option>";
   $carType = CarType::with(['carSubType'])->find($parentId);
   if($carType){
     foreach ($carType->carSubType as $value){
       $selectSub = '';
       if($value->id == $subSelectedId ){
         $selectSub =  'selected'; 
       }
       $html .= '<option '.$selectSub.' value="' . $value->id .'">'. $value->en_name .'</option>';
     }
   }
    return response()->json(['status' => 200, 'msg' => 'Success','data' => $html]);
  }


public function changeUserStatus(Request $request){
   $userCarId =  $request->userCarId;
   $userStatus =  $request->userStatus;
   
   Car::where('id',$userCarId)->update([
     'active_status' => $userStatus
  ]);
  return response()->json(['status' => 200, 'msg' => 'Status Updated Succesfully']);
}



}