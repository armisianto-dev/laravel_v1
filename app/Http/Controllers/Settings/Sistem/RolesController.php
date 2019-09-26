<?php

namespace App\Http\Controllers\Settings\Sistem;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\DeveloperBase;

use App\Models\Settings\Sistem\RolesModel;
use App\Models\Settings\Sistem\GroupsModel;

class RolesController extends DeveloperBase
{

  public function index(Request $request){
    $this->_set_page_rule('R');

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_js('plugins/select2/js/select2.min.js');

    // Set search parameter
    $search = $request->session()->get('session_sistem_roles');
    $role_nm = empty($search['role_nm']) ? '%' : '%'.$search['role_nm'].'%';
    $group_id = empty($search['group_id']) ? '%' : $search['group_id'];

    $rs_group = GroupsModel::orderBy('group_id')->get();

    $rs_result = RolesModel::getAll([$group_id, $role_nm]);
    return view('Settings.Sistem.Roles.index', compact('rs_result','rs_group','search'));
  }

  public function search(Request $request){
    $this->_set_page_rule('R');

    $search = array();
    $search['role_nm'] = $request->input('role_nm');
    $search['group_id'] = $request->input('group_id');

    $request->session()->put('session_sistem_roles', $search);
    return redirect('/sistem/roles');
  }

  public function create(){
    $this->_set_page_rule('C');

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_js('plugins/select2/js/select2.min.js');

    $rs_group = GroupsModel::orderBy('group_id')->get();

    return view('Settings.Sistem.Roles.create', compact('rs_group'));
  }

  public function insert(Request $request){
    $this->_set_page_rule('C');

    $validator = Validator::make($request->all(), [
      'group_id' => 'required',
      'role_nm' => 'required|max:100|unique:com_role,role_nm',
      'role_desc' => 'required|max:100',
      'default_page' => 'required|max:50',
    ],[
      'group_id.required' => 'Group ID harus diisi',
      'role_nm.required' => 'Nama Role harus diisi',
      'role_nm.max' => 'Nama Role max 100 karakter',
      'role_desc.required' => 'Role Desc harus diisi',
      'role_desc.max' => 'Role Desc max 100 karakter',
      'default_page.required' => 'Default page harus diisi',
      'default_page.max' => 'Default page max 50 karakter',
    ]);

    if($validator->fails()){
      $messages = $validator->errors();
      return redirect('/sistem/roles/create')->with('error','Data roles gagal ditambahkan')->withErrors($messages);
    }

    // Create RolesID
    $role_id = RolesModel::getNewID(array($request->input('group_id')));

    if(RolesModel::create([
      'role_id' => $role_id,
      'group_id' => $request->input('group_id'),
      'role_nm' => $request->input('role_nm'),
      'role_desc' => $request->input('role_desc'),
      'default_page' => $request->input('default_page'),
      'mdb' => $this->com_user['user_id']
      ])){
        return redirect('/sistem/roles/create')->with('success','Data roles berhasil ditambahkan');
      }

      return redirect('/sistem/roles/create')->with('error','Data roles gagal ditambahkan');
    }

    public function edit($role_id = null){
      $this->_set_page_rule('U');

      $this->add_load_style('plugins/select2/css/select2.min.css');
      $this->add_load_js('plugins/select2/js/select2.min.js');

      if(!$role_id){
        return redirect('/sistem/roles')->with('error','Data role tidak ditemukan');
      }

      $result = RolesModel::where('role_id', $role_id)->first();
      if(!$result){
        return redirect('/sistem/roles')->with('error','Data role tidak ditemukan');
      }

      $rs_group = GroupsModel::orderBy('group_id')->get();

      return view('Settings.Sistem.Roles.edit', compact('result', 'role_id', 'rs_group'));
    }

    public function update(Request $request, $role_id = null){
      $this->_set_page_rule('U');

      if(!$role_id){
        return redirect('/sistem/roles')->with('error','Data role tidak ditemukan');
      }

      $validator = Validator::make($request->all(), [
        'group_id' => 'required',
        'role_nm' => 'required|max:100|unique:com_role,role_nm,'.$request->input('role_nm').',role_nm',
        'role_desc' => 'required|max:100',
        'default_page' => 'required|max:50',
      ],[
        'group_id.required' => 'Group ID harus diisi',
        'role_nm.required' => 'Nama Role harus diisi',
        'role_nm.max' => 'Nama Role max 100 karakter',
        'role_desc.required' => 'Role Desc harus diisi',
        'role_desc.max' => 'Role Desc max 100 karakter',
        'default_page.required' => 'Default page harus diisi',
        'default_page.max' => 'Default page max 50 karakter',
      ]);

      if($validator->fails()){
        $messages = $validator->errors();
        return redirect('/sistem/roles/edit/'.$role_id)->with('error','Data role gagal diedit')->withErrors($messages);
      }

      $data = RolesModel::where('role_id', $role_id)->first();

      if($data->group_id != $request->input('group_id')){
        // Create RolesID
        $role_id = RolesModel::getNewID(array($request->input('group_id')));
      }

      $data->role_id = $role_id;
      $data->group_id = $request->input('group_id');
      $data->role_nm = $request->input('role_nm');
      $data->role_desc = $request->input('role_desc');
      $data->default_page = $request->input('default_page');
      $data->mdb = $this->com_user['user_id'];
      if($data->save()){
        return redirect('/sistem/roles')->with('success','Data role berhasil diedit');
      }

      return redirect('/sistem/roles/edit/'.$role_id)->with('error','Data role gagal diedit');
    }

    public function delete($role_id = null){
      $this->_set_page_rule('D');

      if(!$role_id){
        return redirect('/sistem/roles')->with('error','Data role tidak ditemukan');
      }

      $result = RolesModel::where('role_id', $role_id)->first();

      if(!$result){
        return redirect('/sistem/roles')->with('error','Data role tidak ditemukan');
      }

      $group = GroupsModel::where('group_id', $result->group_id)->first();

      return view('Settings.Sistem.Roles.delete', compact('result', 'group', 'role_id'));
    }

    public function remove($role_id = null){
      $this->_set_page_rule('D');

      if(!$role_id){
        return redirect('/sistem/roles')->with('error','Data role tidak ditemukan');
      }

      if(RolesModel::where('role_id', $role_id)->delete()){
        return redirect('/sistem/roles')->with('success','Data role berhasil dihapus');
      }

      return redirect('/sistem/roles/delete/'.$role_id)->with('error','Data role gagal dihapus');
    }

  }
