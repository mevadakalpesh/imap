<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use DataTables;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    
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
  public function aboutUs() {
    $theAboutUs = AboutUs::where('type','AboutUs')->first();
    if(!$theAboutUs){
      abort(404);
    }
    return view('about-us.about-us-edit', [
      'theAboutUs' => $theAboutUs,
    ]);
  }
  
  public function termCondition() {
    $theAboutUs = AboutUs::where('type','Term')->first();
    if(!$theAboutUs){
      abort(404);
    }
    return view('about-us.term-edit', [
      'theAboutUs' => $theAboutUs,
    ]);
  }
   


  /**
  * Update the specified resource in storage.
  */
  public function aboutUsUpdate(Request $request) {
    
    $request->validate([
      'descriptionEn' => 'required',
      'descriptionAr' => 'required',
      'email' => 'required_if:type,AboutUs',
      'id' => 'required',
      'type' => 'required',
      'nameEn' => 'required_if:type,Term',
      'nameAr' => 'required_if:type,Term',
    ]);
    try {
      $data = [
        "descriptionEn" => $request->descriptionEn,
        "descriptionAr" => $request->descriptionAr,
        "email" => isset($request->email) && !blank($request->email) ? $request->email : "",
        "nameEn" => isset($request->nameEn) && !blank($request->nameEn) ? $request->nameEn : "",
        "nameAr" => isset($request->nameAr) && !blank($request->nameAr) ? $request->nameAr : "",
      ];
      
      AboutUs::where('id',$request->id)->where('type',$request->type)->update($data);
      session()->flash('success', 'Success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    
  }

}