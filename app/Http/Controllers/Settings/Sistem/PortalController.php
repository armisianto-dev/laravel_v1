<?php

namespace App\Http\Controllers\Settings\Sistem;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\DeveloperBase;
use App\Models\Settings\Sistem\PortalModel;

class PortalController extends DeveloperBase
{

  public function index(){
    $this->_set_page_rule('R');

    $rs_portal = PortalModel::orderBy('portal_id', 'ASC')->get();
    return view('Settings.Sistem.Portal.index', compact('rs_portal'));
  }

  public function create(){
    $this->_set_page_rule('C');

    return view('Settings.Sistem.Portal.create');
  }

  public function insert(Request $request){
    $this->_set_page_rule('C');

    $validator = Validator::make($request->all(), [
      'portal_id' => 'required|numeric|unique:com_portal,portal_id',
      'portal_nm' => 'required|max:50',
      'site_title' => 'required|max:100',
      'site_desc' => 'required|max:100',
      'meta_desc' => 'max:255',
      'meta_keyword' => 'max:255',
    ],[
      'portal_id.required' => 'Portal ID harus diisi',
      'portal_id.numeric' => 'Portal ID harus diisi angka',
      'portal_id.unique' => 'Portal ID sudah digunakan',
      'portal_nm.required' => 'Nama Portal harus diisi',
      'portal_nm.max' => 'Nama Portal max 50 karakter',
      'site_title.required' => 'Site title harus diisi',
      'site_title.max' => 'Site title max 100 karakter',
      'site_desc.required' => 'Site desc harus diisi',
      'site_desc.max' => 'Site desc max 100 karakter',
      'meta_desc.max' => 'Meta desc max 250 karakter',
      'meta_keyword.max' => 'Meta keyword max 250 karakter',
    ]);

    if($validator->fails()){
      $messages = $validator->errors();
      return redirect('/sistem/portal/create')->with('error','Data portal gagal ditambahkan')->withErrors($messages);
    }

    if(PortalModel::create([
      'portal_id' => $request->input('portal_id'),
      'portal_nm' => $request->input('portal_nm'),
      'site_title' => $request->input('site_title'),
      'site_desc' => $request->input('site_desc'),
      'meta_desc' => $request->input('meta_desc'),
      'meta_keyword' => $request->input('meta_keyword')
      ])){
        return redirect('/sistem/portal/create')->with('success','Data portal berhasil ditambahkan');
      }

      return redirect('/sistem/portal/create')->with('error','Data portal gagal ditambahkan');
    }

    public function edit($portal_id = null){
      $this->_set_page_rule('U');

      if(!$portal_id){
        return redirect('/sistem/portal')->with('error','Data portal tidak ditemukan');
      }

      $result = PortalModel::where('portal_id', $portal_id)->first();
      return view('Settings.Sistem.Portal.edit', compact('result', 'portal_id'));
    }

    public function update(Request $request, $portal_id = null){
      $this->_set_page_rule('U');

      if(!$portal_id){
        return redirect('/sistem/portal')->with('error','Data portal tidak ditemukan');
      }

      $validator = Validator::make($request->all(), [
        'portal_id' => 'required|numeric|unique:com_portal,portal_id,'.$portal_id.',portal_id',
        'portal_nm' => 'required|max:50',
        'site_title' => 'required|max:100',
        'site_desc' => 'required|max:100',
        'meta_desc' => 'max:255',
        'meta_keyword' => 'max:255',
      ],[
        'portal_id.required' => 'Portal ID harus diisi',
        'portal_id.numeric' => 'Portal ID harus diisi angka',
        'portal_id.unique' => 'Portal ID sudah digunakan',
        'portal_nm.required' => 'Nama Portal harus diisi',
        'portal_nm.max' => 'Nama Portal max 50 karakter',
        'site_title.required' => 'Site title harus diisi',
        'site_title.max' => 'Site title max 100 karakter',
        'site_desc.required' => 'Site desc harus diisi',
        'site_desc.max' => 'Site desc max 100 karakter',
        'meta_desc.max' => 'Meta desc max 250 karakter',
        'meta_keyword.max' => 'Meta keyword max 250 karakter',
      ]);

      if($validator->fails()){
        $messages = $validator->errors();
        return redirect('/sistem/portal/edit/'.$portal_id)->with('error','Data portal gagal diedit')->withErrors($messages);
      }

      $data = PortalModel::where('portal_id', $portal_id)->first();
      $data->portal_id = $request->input('portal_id');
      $data->portal_nm = $request->input('portal_nm');
      $data->site_title = $request->input('site_title');
      $data->site_desc = $request->input('site_desc');
      $data->meta_desc = $request->input('meta_desc');
      $data->meta_keyword = $request->input('meta_keyword');
      if($data->save()){
        return redirect('/sistem/portal')->with('success','Data portal berhasil diedit');
      }

      return redirect('/sistem/portal/edit/'.$portal_id)->with('error','Data portal gagal diedit');
    }

  }
