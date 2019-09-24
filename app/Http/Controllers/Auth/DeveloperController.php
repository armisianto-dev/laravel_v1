<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Models\Base\Users;

class DeveloperController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    // $this->middleware('guest')->except('logout');
  }

  public function index(Request $request){
    $request->session()->forget('login_developer');
    return view('Auth.Developer.index');
  }

  public function authenticating(Request $request){
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'password' => 'required',
    ],[
      'username.required' => 'Username/E-Mail harus diisi',
      'password.required' => 'Password harus diisi',
    ]);

    if($validator->fails()){
      $messages = $validator->errors();
      return redirect('/auth/developer')->with('error','Login Gagal !')->withErrors($messages);
    }

    $username = $request->input('username');
    $password = $request->input('password');

    // Find the user by username
    $user = Users::getUserLogin(array($username));
    if (!$user) {
      return redirect('/auth/developer')->with('error','Login Gagal : User tidak ditemukan!');
    }

    // Verify the password
    if (Hash::check($password.$user[0]['user_key'], $user[0]['user_pass'])) {
        $arr_session = [
          "user_id" => $user[0]['user_id'],
          "user_alias" => $user[0]['user_alias'],
          "user_email" => $user[0]['user_mail'],
          "default_page" => $user[0]['default_page'],
          "role_nm" => $user[0]['role_nm']
        ];

        // save session
        $request->session()->put('login_developer', $arr_session);

        return redirect("/".$user[0]['default_page']);
    }

    return redirect('/auth/developer')->with('error','Login Gagal : Password salah!');
  }

  public function logout(Request $request){
    $request->session()->forget('login_developer');

    return redirect('/auth/developer');
  }

  public function generate_password($password = null){
    $key = $this->random_string("numeric", 6);

    $password = $password.$key;
    $hash_password = Hash::make($password);
    echo "Key : ".$key."<br>";
    echo "Password : ".$hash_password;
    exit();
  }

  private function random_string($type = null, $length = null) {
      $type = empty($type) ? 'alphanumeric' : $type;
      $length = empty($length) ? 6 : $length;

      if($type == "alphanumeric"){
        $pool = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
      }else{
        $pool = '123456789';
      }
      $str = '';
      for ($i = 0; $i < $length; $i++) {
        $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
      }
      return $str;
    }
}
