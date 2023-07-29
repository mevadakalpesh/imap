<?php
use Illuminate\Support\Facades\Auth;
use App\Models\User;

function isAdmin(){
  $staus  = false;
  if(Auth::check()){
    if(Auth::user()->is_admin == User::$admin){
      $staus = true;
    }
  }
  return $staus;
}
