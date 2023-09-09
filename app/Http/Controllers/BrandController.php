<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Field;
use DataTables;

use Illuminate\Support\Facades\Validator;



class BrandController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    if ($request->ajax()) {
      $data = Brand::get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->editColumn('image', function(Brand $brand) {
        return '<img src="'.$brand->image.'" width="100px" height="100px" />';
      })
      ->editColumn('type', function(Brand $brand) {
        return $brand->type == 1 ? "Emergency":"Brand";
      })
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('brand.edit', $row->id).'" data-brandid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-brandid="'.$row->id.'" class="btn delete-brand btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
        return $btn;
      })
      ->rawColumns(['image', 'action'])
      ->make(true);
    }

    return view('brand.brand-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    return view('brand.brand-create');
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {

    $request->validate([
      'image' => 'required',
      'en_name' => 'required',
      'ar_name' => 'required',
      'type' => 'required'
    ]);
    try {
      
      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
        "price" => isset($request->price) ? $request->price : "",
        'type' => $request->type == 'Emergency' ? 1 : 0,
      ];

      if ($request->file('image')) {
        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $data['image'] = $fileName;
      }

      $category = Brand::create($data);
      $field = new Field();
      $is_erm = $request->type == 'Emergency' ? true : false;
      if ($is_erm) {
        $field->note = 1;
        $field->pickLocation = 1;
        $field->phone = 1;
      } else {
        $field->note = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->pickLocation = isset($request->pickLocation) & !blank($request->pickLocation) ? 1 : 0;
        $field->phone = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->selectCar = isset($request->selectCar) & !blank($request->selectCar) ? 1 : 0;
        $field->manufactory = isset($request->manufactory) & !blank($request->manufactory) ? 1 : 0;
        $field->batteryVoltage = isset($request->batteryVoltage) & !blank($request->batteryVoltage) ? 1 : 0;
        $field->withService = isset($request->withService) & !blank($request->withService) ? 1 : 0;
        $field->carLicense = isset($request->carLicense) & !blank($request->carLicense) ? 1 : 0;
        $field->carLicense2 = isset($request->carLicense2) & !blank($request->carLicense2) ? 1 : 0;
        $field->withFilter = isset($request->withFilter) & !blank($request->withFilter) ? 1 : 0;
        $field->pickDate = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->startTime = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->endTime = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->PaymentMethod = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;

      }
      $field->type = 'Brand';
      $field->itemId = $category->id;
      $field->save();

      session()->flash('success', 'Brand Add SucesaFully');

    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('brand.index');
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
    $brand = Brand::with('fields')->find($id);
    return view('brand.brand-edit', [
      'brand' => $brand
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
    
    //dd($request->all());
    
    $request->validate([
      'en_name' => 'required',
      'ar_name' => 'required',
      'type' => 'required'
    ]);
    try {
      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
        "price" => isset($request->price) ? $request->price : "",
        'type' => $request->type == 'Emergency' ? 1 : 0,
      ];

      if ($request->file('image')) {
        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $data['image'] = $fileName;
      }

      Brand::where('id', $id)->update($data);
      $category = Brand::find($id);
      $field = Field::find($request->fieldId);
      $is_erm = $request->type == 'Emergency' ? true : false;
      if ($is_erm) {
        $field->note = 1;
        $field->pickLocation = 1;
        $field->phone = 1;
      } else {
        $field->note = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->pickLocation = isset($request->pickLocation) & !blank($request->pickLocation) ? 1 : 0;
        $field->phone = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->selectCar = isset($request->selectCar) & !blank($request->selectCar) ? 1 : 0;
        $field->manufactory = isset($request->manufactory) & !blank($request->manufactory) ? 1 : 0;
        $field->batteryVoltage = isset($request->batteryVoltage) & !blank($request->batteryVoltage) ? 1 : 0;
        $field->withService = isset($request->withService) & !blank($request->withService) ? 1 : 0;
        $field->carLicense = isset($request->carLicense) & !blank($request->carLicense) ? 1 : 0;
        $field->carLicense2 = isset($request->carLicense2) & !blank($request->carLicense2) ? 1 : 0;
        $field->withFilter = isset($request->withFilter) & !blank($request->withFilter) ? 1 : 0;
        $field->pickDate = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->startTime = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->endTime = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;
        $field->PaymentMethod = isset($request->pickDate) & !blank($request->pickDate) ? 1 : 0;

      }
      $field->type = 'Brand';
      $field->itemId = $category->id;
      $field->save();

      session()->flash('success', 'Brand Edit SucesaFully');

    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('brand.index');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    $category = Brand::where('id', $id)->delete();
    return response()->json(['status' => 200, 'msg' => 'Success']);
  }
}