<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandCategory;
use App\Models\Brand;
use DataTables;
use Illuminate\Support\Facades\Validator;

class BrandCategoryController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    if ($request->ajax()) {
      $data = BrandCategory::get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->editColumn('image', function(BrandCategory $brand) {
        return '<img src="'.$brand->image.'" width="100px" height="100px" />';
      })
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('brand-category.edit', $row->id).'" data-serviceid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-serviceid="'.$row->id.'" class="btn delete-service btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
        return $btn;
      })
      ->rawColumns(['image', 'action'])
      ->make(true);
    }

    return view('brand-category.brand-category-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    $brands = Brand::where('type',0)->get();
    return view('brand-category.brand-category-create', [
      'brands' => $brands
    ]);
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {
    $request->validate([
      'image' => 'required',
      'en_name' => 'required',
      'ar_name' => 'required',
      'brands' => 'required'
    ]);
    try {

      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
      ];

      if ($request->file('image')) {
        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $data['image'] = $fileName;
      }

      $category = BrandCategory::create($data);
      $category->brands()->attach($request->brands);
      session()->flash('success','success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('brand-category.index');
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
  $categoryBrands = BrandCategory::with(['brands'])->find($id);
  
  $brands = Brand::where('type',0)->get();
    return view('brand-category.brand-category-edit', [
      'brands' => $brands,
      'categoryBrands' => $categoryBrands
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
    $request->validate( [
      'en_name' => 'required',
      'ar_name' => 'required',
      'brands' => 'required'
    ]);
    try {

      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
      ];

      if ($request->file('image') && $request->has('image')) {
        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $data['image'] = $fileName;
      }

      BrandCategory::where('id',$id)->update($data);
      $category = BrandCategory::find($id);
      $category->brands()->sync($request->brands);
      session()->flash('success','success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('brand-category.index');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
     BrandCategory::find($id)->delete();
    return response()->json(['status' => 200,'msg' => 'Success']);
  }
}