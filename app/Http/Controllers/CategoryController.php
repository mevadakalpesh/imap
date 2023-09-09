<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    if ($request->ajax()) {
      $data = Category::get();
      return DataTables::of($data)
      ->addIndexColumn()
      ->editColumn('image', function(Brand $brand) {
        return '<img src="'.$brand->image.'" width="100px" height="100px" />';
      })
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('brand.edit', $row->id).'" data-serviceid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-serviceid="'.$row->id.'" class="btn delete-service btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
        return $btn;
      })
      ->rawColumns(['image', 'action'])
      ->make(true);
    }
return view('category.list-category');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    return view('category.create-category');
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {




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
    //
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
    //
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    //
  }
}