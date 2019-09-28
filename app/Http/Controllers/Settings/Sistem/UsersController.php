<?php

namespace App\Http\Controllers\Settings\Sistem;

use DB;
use File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\DeveloperBase;

use App\Models\Settings\Sistem\RolesModel;
use App\Models\Settings\Sistem\UsersModel;
use App\Models\Settings\Sistem\RoleUserModel;

class UsersController extends DeveloperBase
{

  public function index(Request $request){
    $this->_set_page_rule('R');

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_js('plugins/select2/js/select2.min.js');

    // Search parameter
    $search = $request->session()->get('session_sistem_users');
    $user_name = empty($search['user_name']) ? '%' : '%'.$search['user_name'].'%';
    $role_id = empty($search['role_id']) ? '%' : $search['role_id'];

    $rs_role = RolesModel::orderBy('role_id','ASC')->get();
    $rs_result = UsersModel::getAll([$user_name, $user_name, $role_id]);

    return view('Settings.Sistem.Users.index', compact('search','rs_role','rs_result'));
  }

  public function search(Request $request){
    $this->_set_page_rule('R');

    $search = array();
    $search['user_name'] = $request->input('user_name');
    $search['role_id'] = $request->input('role_id');

    $request->session()->put('session_sistem_users', $search);
    return redirect('/sistem/users');
  }

  public function create(){
    $this->_set_page_rule('C');

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_style('plugins/croppie/croppie.min.css');

    $this->add_load_js('plugins/select2/js/select2.min.js');
    $this->add_load_js('plugins/croppie/croppie.js');

    $rs_role = RolesModel::orderBy('role_id','ASC')->get();

    return view('Settings.Sistem.Users.create', compact('rs_role'));
  }

  public function insert(Request $request){
    $this->_set_page_rule('C');

    $validator = Validator::make($request->all(), [
      'role_id' => 'required',
      'user_alias' => 'required|max:50',
      'user_mail' => 'required|max:50|email|unique:com_user,user_mail',
      'user_pass' => 'required|min:6',
      'user_pass_confirm' => 'required|same:user_pass',
      'user_img' => 'mimes:jpeg,jpg,png',
    ],[
      'role_id.required' => 'Role harus diisi',
      'user_alias.required' => 'Nama harus diisi',
      'user_alias.max' => 'Nama max 50 karakter',
      'user_mail.required' => 'Email harus diisi',
      'user_mail.max' => 'Email maksimal 50 karakter',
      'user_mail.email' => 'Format penulisan email salah',
      'user_mail.unique' => 'Email sudah digunakan',
      'user_pass.required' => 'Password harus diisi',
      'user_pass.min' => 'Password minimal 6 karakter',
      'user_pass_confirm.required' => 'Konfirmasi Password harus diisi',
      'user_pass_confirm.same' => 'Konfirmasi Password salah',
      'user_img.mimes' => 'Hanya boleh menggunakan gambar dengan ekstensi jpeg,jpg,png',
    ]);

    if($validator->fails()){
      $messages = $validator->errors();
      return redirect('/sistem/users/create')->with('error','Data user gagal ditambahkan')->withErrors($messages);
    }

    // Create UserID
    $user_id = UsersModel::getNewID(array(date('ymd')));

    $password = $request->input('user_pass');
    $key = $this->random_string("numeric", 6);

    $password = $password.$key;
    $hash_password = Hash::make($password);

    // Images
    $path_ori = 'public/images/users/';
    $path_link = 'storage/images/users/';
    if($request->input('user_img_result')){
      $image = $request->input('user_img_result');

      //JIKA FOLDERNYA BELUM ADA
      if (!Storage::disk('public')->exists($path_ori)) {
        //MAKA FOLDER TERSEBUT AKAN DIBUAT
        Storage::makeDirectory($path_ori);
      }

      list($type, $image) = explode(';', $image);
      list(, $image)      = explode(',', $image);
      $image = base64_decode($image);
      $user_img_name = 'IMG_'.$user_id.'.png';

      $upload = Storage::put($path_ori.$user_img_name, $image, 'public');
      if($upload){
        if(UsersModel::create([
          'user_id' => $user_id,
          'user_alias' => $request->input('user_alias'),
          'user_name' => $request->input('user_mail'),
          'user_pass' => $hash_password,
          'user_key' => $key,
          'user_mail' => $request->input('user_mail'),
          'user_img_name' => $user_img_name,
          'user_img_path' => $path_link,
          'user_mail' => $request->input('user_mail'),
          'user_st' => "1",
          'user_completed' => "1",
          'mdb' => $this->com_user['user_id']
          ])){
            // Insert com_role_user
            RoleUserModel::create([
              'user_id' => $user_id,
              'role_id' => $request->input('role_id')
            ]);

            return redirect('/sistem/users/create')->with('success','Data user berhasil ditambahkan');
          }
        }else{
          return redirect('/sistem/users/create')->with('error','Data user gagal ditambahkan')->withErrors(array('Gambar gagal diupload'));
        }
      }else{
        if(UsersModel::create([
          'user_id' => $user_id,
          'user_alias' => $request->input('user_alias'),
          'user_name' => $request->input('user_mail'),
          'user_pass' => $hash_password,
          'user_key' => $key,
          'user_mail' => $request->input('user_mail'),
          'user_mail' => $request->input('user_mail'),
          'user_st' => "1",
          'user_completed' => "1",
          'mdb' => $this->com_user['user_id']
          ])){
            // Insert com_role_user
            RoleUserModel::create([
              'user_id' => $user_id,
              'role_id' => $request->input('role_id')
            ]);

            return redirect('/sistem/users/create')->with('success','Data user berhasil ditambahkan');
          }

          return redirect('/sistem/users/create')->with('error','Data user gagal ditambahkan');
        }
      }

      public function edit($user_id = null){
        $this->_set_page_rule('U');

        if(!$user_id){
          return redirect('/sistem/users')->with('error','Data user tidak ditemukan');
        }

        $this->add_load_style('plugins/select2/css/select2.min.css');
        $this->add_load_js('plugins/select2/js/select2.min.js');

        $result = UsersModel::getDetail($user_id);
        if(!$result){
          return redirect('/sistem/users')->with('error','Data user tidak ditemukan');
        }

        $rs_role = RolesModel::orderBy('role_id','ASC')->get();

        return view('Settings.Sistem.Users.edit', compact('result','user_id','rs_role'));
      }

      public function update(Request $request, $user_id = null){
        $this->_set_page_rule('U');

        if(!$user_id){
          return redirect('/sistem/users')->with('error','Data user tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
          'role_id' => 'required',
          'user_alias' => 'required|max:50',
          'user_mail' => 'required|max:50|email|unique:com_user,user_mail,'.$user_id.',user_id',
          'user_pass' => 'nullable|min:6',
          'user_pass_confirm' => 'nullable|same:user_pass',
        ],[
          'role_id.required' => 'Role harus diisi',
          'user_alias.required' => 'Nama harus diisi',
          'user_alias.max' => 'Nama max 50 karakter',
          'user_mail.required' => 'Email harus diisi',
          'user_mail.max' => 'Email maksimal 50 karakter',
          'user_mail.email' => 'Format penulisan email salah',
          'user_mail.unique' => 'Email sudah digunakan',
          'user_pass.min' => 'Password minimal 6 karakter',
          'user_pass_confirm.same' => 'Konfirmasi Password salah',
        ]);

        if($validator->fails()){
          $messages = $validator->errors();
          return redirect('/sistem/users/edit/'.$user_id)->with('error','Data user gagal diedit')->withErrors($messages);
        }

        $data = UsersModel::where('user_id', $user_id)->first();
        $data->user_alias = $request->input('user_alias');
        $data->user_name = $request->input('user_mail');
        $data->user_mail = $request->input('user_mail');
        $data->mdb = $this->com_user['user_id'];

        $password = $request->input('user_pass');
        if($password){
          $key = $this->random_string("numeric", 6);

          $password = $password.$key;
          $hash_password = Hash::make($password);

          $data->user_pass = $hash_password;
          $data->user_key = $key;
        }

        if($data->save()){
          $user = UsersModel::getDetail($user_id);
          if($user->role_id != $request->input('role_id')){
            $role_user = RoleUserModel::where('user_id', $user_id)->first();
            $role_user->user_id = $user_id;
            $role_user->role_id = $request->input('role_id');
            $role_user->save();
          }

          return redirect('/sistem/users')->with('success','Data user berhasil diedit');
        }

        return redirect('/sistem/users')->with('error','Data user gagal diedit');
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
