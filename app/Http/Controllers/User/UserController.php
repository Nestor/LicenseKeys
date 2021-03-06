<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePassword;
use Auth;
use DB;
use Carbon\Carbon;


class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function updateUser(Request $request)
  {
    $request->validate([
        'email' => 'required',
        'username' => 'min:6|max:255|required',
    ]);
    $userid = Auth::user()->id;    
    DB::table('users')
      ->where('id', $userid)
      ->update([
        'fname' => $request->fname, 
        'lname' => $request->lname,
        'email' => $request->email,
        'username' => $request->username,
        'updated_at' => Carbon::now()
        ]);
    return "
      <div class='alert alert-success' role='alert'>
        <strong>Complete</strong> Your information has been successfully updated!
      </div>
    ";
  }

  public function updatePass(ChangePassword $request)
  {
    $password = Auth::user()->password;
    if(Hash::check($request->password, $password)){

    } 
  }
}
