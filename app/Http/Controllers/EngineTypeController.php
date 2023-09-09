<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EngineType;
use DataTables;
use Illuminate\Support\Facades\Validator;

class EngineTypeController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    if ($request->ajax()) {
      $data = EngineType::get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('engine-type.edit', $row->id).'" data-engine-typeid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-engine-typeid="'.$row->id.'" class="btn delete-engine-type btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
        return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    return view('engine-type.engine-type-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    return view('engine-type.engine-type-create');
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {
    $request->validate([
      'en_name' => 'required',
      'ar_name' => 'required'
    ]);
    try {
      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
      ];
      EngineType::create($data);
      session()->flash('success', 'Engine Type Add SucesaFully');
    } catch (\Exception $e) {
      throw $e;
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('engine-type.index');
    
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
    $theEngineType = EngineType::find($id);
    return view('engine-type.engine-type-edit', [
      'theEngineType' => $theEngineType,
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
    $request->validate([
      'en_name' => 'required',
      'ar_name' => 'required'
    ]);
    try {
      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
      ];
      EngineType::where('id',$id)->update($data);
      session()->flash('success', 'Engine Type Add SucesaFully');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('engine-type.index');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    $category = EngineType::where('id', $id)->delete();
    return response()->json(['status' => 200, 'msg' => 'Success']);
  }

}