<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Brand;
use DataTables;
use Illuminate\Support\Facades\Validator;
class ServiceController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    
    if ($request->ajax()) {
      $data = Service::get();
      return Datatables::of($data)
      ->addIndexColumn()
       ->editColumn('image', function(Service $brand) {
        return '<img src="'.$brand->image.'" width="100px" height="100px" />';
      })
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('service.edit', $row->id).'" data-serviceid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-serviceid="'.$row->id.'" class="btn delete-service btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
        return $btn;
      })
      ->rawColumns(['image','action'])
      ->make(true);
    }
    
    return view('services.service-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    $brandCategory = Brand::where('type',0)->get();
    return view('services.createService',[
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
      'serviceCategories' => 'required',
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

      $service = Service::create($data);
      $service->serviceCategories()->attach($request->serviceCategories);

    
      session()->flash('success','success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    
    return redirect()->route('service.index');
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
    $service = Service::with(['serviceCategories'])->find($id);
    $brandCategory = Brand::where('type',0)->get();
    return view('services.service-edit',[
      'brandCategory' => $brandCategory,
      'service' => $service
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
    $request->validate([
      'en_name' => 'required',
      'ar_name' => 'required',
      'serviceCategories' => 'required'
    ]);
    try {
      
      $data = [
        "en_name" => $request->en_name,
        "ar_name" => $request->ar_name,
      ];

      if ($request->file('image') && $request->has('image') ) {
        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $data['image'] = $fileName;
      }

       Service::where('id',$id)->update($data);
       $service = Service::find($id);
       $service->serviceCategories()->sync($request->serviceCategories);
      session()->flash('success','success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    
    return redirect()->route('service.index');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    Service::find($id)->delete();
    return response()->json(['status' => 200,'msg' => 'Success']);
  }
}