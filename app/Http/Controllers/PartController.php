<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\BrandCategory;
use DataTables;
use Illuminate\Support\Facades\Validator;


class PartController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {

    if ($request->ajax()) {
      $data = Part::get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->editColumn('image', function(Part $brand) {
        return '<img src="'.$brand->image.'" width="100px" height="100px" />';
      })
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('part.edit', $row->id).'" data-partid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-partid="'.$row->id.'" class="btn delete-part btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
        return $btn;
      })
      ->rawColumns(['image', 'action'])
      ->make(true);
    }

    return view('part.part-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    $brandCategory = BrandCategory::get();
    return view('part.part-create', [
      'brandCategory' => $brandCategory
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
      'brandCategories' => 'required',
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

      $part = Part::create($data);
      $part->brandCategories()->attach($request->brandCategories);


      session()->flash('success', 'success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }

    return redirect()->route('part.index');
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
    $part = Part::with(['brandCategories'])->find($id);
    $brandCategory = BrandCategory::get();
    return view('part.part-edit', [
      'brandCategory' => $brandCategory,
      'part' => $part
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
    $request->validate([
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

      Part::where('id', $id)->update($data);
      $part = Part::find($id);
      $part->brandCategories()->sync($request->brandCategories);
      session()->flash('success', 'success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }

    return redirect()->route('part.index');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    Part::find($id)->delete();
    return response()->json(['status' => 200,'msg' => 'Success']);
  }
}