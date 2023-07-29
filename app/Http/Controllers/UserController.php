<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
class UserController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request)
    {
      if ($request->ajax()) {
            $data = User::latest()->where('is_admin','!=',User::$admin)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           
                           $btn = '
                           <a href="'.route('user.edit',$row->id).'" data-userid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
                           <button type="button" data-userid="'.$row->id.'" class="btn delete-user btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                           ';
                           
                           
                           if($row->status == User::$pending){
                             $btn .= ' <button type="button" data-userid="'.$row->id.'" class="change-status btn delete-user btn-success btn-sm" data-status="Approved">Approved</button>';
                           }else {
                             $btn .= ' <button type="button" data-userid="'.$row->id.'" class="change-status btn delete-user btn-warning btn-sm" data-status="Pending">Pending</button>';
                           }
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('users.user-list');
    }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    //
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {
    //
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
    
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    try {
        User::where('id',$id)->delete();
        return response()->json(['status' => 200,'msg' => "User Deleted Successfully"]);
    } catch (\Exception $e) {
       return response()->json(['status' => 101,'msg' => $e->getMessage()]);
    }
  }
  
  
  public function changeUserStatus(Request $request){
   
   try {
     User::where('id',$request->user_id)->update([
      'status' => $request->statusType == 'Approved' ? 1 : 0,
    ]);
    return response()->json(['status' => 200,'msg' => "User Status Changed Successfully"]);
   } catch (\Exception $e) {
     return response()->json(['status' => 101,'msg' => $e->getMessage()]);
   }
    
    
    
  }
}