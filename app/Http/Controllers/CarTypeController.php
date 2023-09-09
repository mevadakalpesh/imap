<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarType;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class CarTypeController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    if ($request->ajax()) {
      $data = CarType::get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->editColumn('image', function(CarType $carType) {
        return '<img src="'.$carType->image.'" width="100px" height="100px" />';
      })
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('car-type.edit', $row->id).'" data-car-typeid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-car-typeid="'.$row->id.'" class="btn delete-car-type btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
        return $btn;
      })
      ->rawColumns(['image', 'action'])
      ->make(true);
    }

    return view('car-type.car-type-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    $carTypes = CarType::where('type','carSubType')->get();
    return view('car-type.car-type-create',[
      'carTypes' => $carTypes
    ]);
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {
    $request->validate([
      'image' => Rule::requiredIf(function () use ($request) {
        return $request->input('type') === 'Car';
      }),
      'en_name' => 'required',
      'carSubType' => Rule::requiredIf(function () use ($request) {
        return $request->input('type') === 'Car';
        }),
      'ar_name' => 'required',
      'type' => 'required',
    ]);
    try {

      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
        "type" => $request->type
      ];

      if ($request->file('image')) {
        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $data['image'] = $fileName;
      }

      $carType = CarType::create($data);
      if($request->type == "Car" && isset($request->carSubType) && !empty($request->carSubType)){
        $carType->carSubType()->attach($request->carSubType);
      }
    
      session()->flash('success', 'Car Type Add SucesaFully');
    } catch (\Exception $e) {
      throw $e;
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('car-type.index');
  }

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
    $theCarType = CarType::with('carSubType')->find($id);
    $carTypes = CarType::where('type','carSubType')->where('id','!=',$id)->get();
    return view('car-type.car-type-edit', [
      'carTypes' => $carTypes,
      'theCarType' => $theCarType,
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
    $request->validate([
      'en_name' => 'required',
      'carSubType' => Rule::requiredIf(function () use ($request) {
        return $request->input('type') === 'Car';
      }),
      'ar_name' => 'required',
      'type' => 'required',
    ]);
    try {

      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
        "type" => $request->type,
      ];

      if ($request->file('image')) {
        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $data['image'] = $fileName;
      }

      CarType::where('id',$id)->update($data);
      $carType = CarType::find($id);
      
      if($request->type == "Car" && isset($request->carSubType) && !empty($request->carSubType)){
        $carType->carSubType->sync($request->carSubType);
      }
      
    
      session()->flash('success', 'Car Type Update SucesaFully');
    } catch (\Exception $e) {
      throw $e;
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('car-type.index');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    $category = CarType::where('id', $id)->delete();
    return response()->json(['status' => 200, 'msg' => 'Success']);
  }

}