<?php

namespace App\Http\Controllers\Settings\Sistem;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\DeveloperBase;
use App\Models\Settings\Sistem\GroupsModel;

class GroupsController extends DeveloperBase
{

  public function index(Request $request){
    $this->_set_page_rule('R');

    // Set search parameter
    $search = $request->session()->get('session_sistem_groups');
    $group_name = empty($search['group_name']) ? '%' : '%'.$search['group_name'].'%';

    $rs_result = GroupsModel::whereRaw('group_name LIKE ? ', [$group_name])
      ->orderBy('group_id', 'ASC')
      ->paginate(10);
    return view('Settings.Sistem.Groups.index', compact('rs_result','search'));
  }

  public function search(Request $request){
    $this->_set_page_rule('R');

    $search = array();
    $search['group_name'] = $request->input('group_name');

    $request->session()->put('session_sistem_groups', $search);
    return redirect('/sistem/groups');
  }

  public function create(){
    $this->_set_page_rule('C');

    return view('Settings.Sistem.Groups.create');
  }

  public function insert(Request $request){
    $this->_set_page_rule('C');

    $validator = Validator::make($request->all(), [
      'group_id' => 'required|numeric|unique:com_group,group_id',
      'group_name' => 'required|max:50',
      'group_desc' => 'required|max:100',
    ],[
      'group_id.required' => 'Groups ID harus diisi',
      'group_id.numeric' => 'Groups ID harus diisi angka',
      'group_id.unique' => 'Groups ID sudah digunakan',
      'group_name.required' => 'Nama Groups harus diisi',
      'group_name.max' => 'Nama Groups max 50 karakter',
      'group_desc.required' => 'Groups Desc harus diisi',
      'group_desc.max' => 'Groups Desc max 100 karakter',
    ]);

    if($validator->fails()){
      $messages = $validator->errors();
      return redirect('/sistem/groups/create')->with('error','Data group gagal ditambahkan')->withErrors($messages);
    }

    if(GroupsModel::create([
      'group_id' => $request->input('group_id'),
      'group_name' => $request->input('group_name'),
      'group_desc' => $request->input('group_desc'),
      'mdb' => $this->com_user['user_id']
      ])){
        return redirect('/sistem/groups/create')->with('success','Data group berhasil ditambahkan');
      }

      return redirect('/sistem/groups/create')->with('error','Data group gagal ditambahkan');
    }

    public function edit($group_id = null){
      $this->_set_page_rule('U');

      if(!$group_id){
        return redirect('/sistem/groups')->with('error','Data group tidak ditemukan');
      }

      $result = GroupsModel::where('group_id', $group_id)->first();
      if(!$result){
        return redirect('/sistem/groups')->with('error','Data group tidak ditemukan');
      }

      return view('Settings.Sistem.Groups.edit', compact('result', 'group_id'));
    }

    public function update(Request $request, $group_id = null){
      $this->_set_page_rule('U');

      if(!$group_id){
        return redirect('/sistem/groups')->with('error','Data group tidak ditemukan');
      }

      $validator = Validator::make($request->all(), [
        'group_id' => 'required|numeric|unique:com_group,group_id,'.$group_id.',group_id',
        'group_name' => 'required|max:50',
        'group_desc' => 'required|max:100',
      ],[
        'group_id.required' => 'Groups ID harus diisi',
        'group_id.numeric' => 'Groups ID harus diisi angka',
        'group_id.unique' => 'Groups ID sudah digunakan',
        'group_name.required' => 'Nama Groups harus diisi',
        'group_name.max' => 'Nama Groups max 50 karakter',
        'group_desc.required' => 'Groups Desc harus diisi',
        'group_desc.max' => 'Groups Desc max 100 karakter',
      ]);

      if($validator->fails()){
        $messages = $validator->errors();
        return redirect('/sistem/groups/edit/'.$group_id)->with('error','Data group gagal diedit')->withErrors($messages);
      }

      $data = GroupsModel::where('group_id', $group_id)->first();
      $data->group_id = $request->input('group_id');
      $data->group_name = $request->input('group_name');
      $data->group_desc = $request->input('group_desc');
      $data->mdb = $this->com_user['user_id'];
      if($data->save()){
        return redirect('/sistem/groups')->with('success','Data group berhasil diedit');
      }

      return redirect('/sistem/groups/edit/'.$group_id)->with('error','Data group gagal diedit');
    }

    public function delete($group_id = null){
      $this->_set_page_rule('D');

      if(!$group_id){
        return redirect('/sistem/groups')->with('error','Data group tidak ditemukan');
      }

      $result = GroupsModel::where('group_id', $group_id)->first();

      if(!$result){
        return redirect('/sistem/groups')->with('error','Data group tidak ditemukan');
      }

      return view('Settings.Sistem.Groups.delete', compact('result', 'group_id'));
    }

    public function remove($group_id = null){
      $this->_set_page_rule('D');

      if(!$group_id){
        return redirect('/sistem/groups')->with('error','Data group tidak ditemukan');
      }

      if(GroupsModel::where('group_id', $group_id)->delete()){
        return redirect('/sistem/groups')->with('success','Data group berhasil dihapus');
      }

      return redirect('/sistem/groups/delete/'.$group_id)->with('error','Data group gagal dihapus');
    }

  }
