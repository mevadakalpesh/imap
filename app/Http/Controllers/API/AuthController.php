<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{

  public function login(Request $request) {
    try {

      $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required'
      ]);

      if ($validator->fails()) {
        return response()->json([
          "error" => true,
          'message' => $validator->errors()->first(),
          'data' => (object) []
        ]);
      }

      $credentials = $request->only('email', 'password');
      $token = Auth::guard('api')->attempt($credentials);

      if (!$token) {
        return response()->json([
          "error" => true,
          'message' => "Email Or Password Does not Match"
        ]);
      }

      $user = Auth::guard('api')->user();
      $user->token = $token;
      return response()->json([
        "error" => false,
        'message' => "User Login Successfully",
        'data' => $user
      ]);
    } catch (\Exception $e) {
      return response()->json([
        "error" => true,
        'message' => $e->getMessage(),
        'data' => (object) []
      ]);
    }
  }

  public function register(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'email' => 'required|string|email',
      'password' => 'required|confirmed',
      'phone' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        "error" => true,
        'message' => $validator->errors()->first(),
        'data' => (object) []
      ]);
    }

    $userData = [
      'name' => $request->name ? $request->name : "Guest",
      'email' => $request->email ? $request->email : null,
      'password' => $request->password ? Hash::make($request->password) : null,
      'phone' => $request->phone ? $request->phone : null,
      'fcm_token' => $request->fcm_token ? $request->fcm_token : null
    ];

    if ($request->has('image') && isset($request->image)) {
      $file = $request->file('image');
      if ($file) {
        $fileName = $file->hashName();
        $file->move(public_path('/images'), $fileName);
        $userData['image'] = $fileName;
      }
    }

    $user = User::create($userData);
    if ($user) {
      $token = Auth::guard('api')->login($user);
      $user->token = $token;
    }

    return response()->json([
      "error" => false,
      'message' => "User Create Successfully",
      'data' => $user
    ]);
  }

  public function logout() {
    Auth::guard('api')->logout();
    return response()->json([
      "error" => false,
      'message' => "User Logout Successfully"
    ]);
  }

  public function refresh() {
    return response()->json([
      'user' => Auth::guard('api')->user(),
      'authorisation' => [
        'token' => Auth::guard('api')->refresh(),
        'type' => 'bearer',
      ]
    ]);
  }

  public function gestLogin(Request $request) {


    try {
      
      
     $user = User::firstOrCreate([
         'email' => "guest@clickandfix.com"
        ],[
        'name' => "Guest User",
        'email' => "guest@clickandfix.com",
        'password' => Hash::make("guestpassword"),
        'fcm_token' => $request->fcm_token ? $request->fcm_token : null
      ]);
      
    
      $credentials = [
        'email' => "guest@clickandfix.com",
        'password' => 'guestpassword',
      ];
      $token = Auth::guard('api')->attempt($credentials);

      if (!$token) {
        return response()->json([
          "error" => true,
          'message' => "Unauthorized",
          'data' => (object)[]
        ]);
      }

      $user = Auth::guard('api')->user();
      $user->token = $token;
      return response()->json([
        "error" => false,
        'message' => "User Login Successfully",
        'data' => $user
      ]);
    } catch (\Exception $e) {
      return response()->json([
        "error" => true,
        'message' => $e->getMessage(),
        'data' => (object) []
      ]);
    }
  }

}