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
            $data = User::where('is_admin','!=',User::$admin)->get();
          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image', function(User $brand) {
                       return '<img src="'.$brand->image.'" width="100px" height="100px" />';
                      })
                      ->editColumn('isVerified', function(User $brand) {
                        $verifyStatus = "Not Verified";
                        $class = "danger";
                        if($brand->email_verified_at){
                          $verifyStatus = "Verified";
                          $class ="primary";
                        } 
                       return '<span class="badge bg-'.$class.'">'.$verifyStatus.'</span>';
                      })
                    ->addColumn('action', function($row){
                           $btn = '<button type="button" data-userid="'.$row->id.'" class="btn delete-user btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
                            return $btn;
                    })
                    ->rawColumns(['isVerified','image','action'])
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