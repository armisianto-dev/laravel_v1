<?php

namespace App\Http\Controllers\Settings\Sistem;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\DeveloperBase;

use App\Models\Settings\Sistem\NavigationModel;
use App\Models\Settings\Sistem\PortalModel;

class NavigationController extends DeveloperBase
{

  public function index(){
    $this->_set_page_rule('R');

    $rs_result = NavigationModel::getAll();
    return view('Settings.Sistem.Navigation.index', compact('rs_result'));
  }

  public function navigation(Request $request, $portal_id = null){
    $this->_set_page_rule('R');

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_js('plugins/select2/js/select2.min.js');

    // Set search parameter
    $search = $request->session()->get('session_sistem_navigation');
    $parent_id = empty($search['parent_id']) ? 0 : $search['parent_id'];

    $portal = PortalModel::where('portal_id', $portal_id)->first();
    $rs_nav = $this->_get_menu_by_portal($portal_id, $parent_id, "");

    $rs_parent = NavigationModel::where('portal_id', $portal_id)->where('parent_id', 0)->get();

    return view('Settings.Sistem.Navigation.navigation', compact('portal','search','rs_nav','rs_parent'));
  }

  public function search(Request $request, $portal_id = null){
    $this->_set_page_rule('R');

    $search = array();
    $search['parent_id'] = $request->input('parent_id');

    $request->session()->put('session_sistem_navigation', $search);
    return redirect('/sistem/menu/navigation/'.$portal_id);
  }

  public function create($portal_id = null){
    $this->_set_page_rule('C');

    if(!$portal_id){
      return redirect('/sistem/menu');
    }

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_js('plugins/select2/js/select2.min.js');

    $portal = PortalModel::where('portal_id', $portal_id)->first();
    $rs_nav = $this->_get_menu_selectbox_by_portal($portal_id, 0, "", "");

    return view('Settings.Sistem.Navigation.create', compact('portal','rs_nav'));
  }

  public function insert(Request $request, $portal_id = null){
    $this->_set_page_rule('C');

    if(!$portal_id){
      return redirect('/sistem/menu')->with('error','Portal ID kosong');
    }

    $validator = Validator::make($request->all(), [
      'parent_id' => 'required',
      'nav_title' => 'required|max:50',
      'nav_desc' => 'required|max:100',
      'nav_url' => 'required|max:100|unique:com_menu,nav_url',
      'nav_no' => 'required|numeric',
      'nav_icon' => 'max:50',
    ],[
      'parent_id.required' => 'Induk menu harus diisi',
      'nav_title.required' => 'Nama menu harus diisi',
      'nav_title.max' => 'Nama menu max 50 karakter',
      'nav_desc.required' => 'Deskripsi menu harus diisi',
      'nav_desc.max' => 'Deskripsi menu max 100 karakter',
      'nav_url.required' => 'URL menu harus diisi',
      'nav_url.max' => 'URL menu max 100 karakter',
      'nav_url.unique' => 'URL menu sudah digunakan',
      'nav_no.required' => 'Urutan menu harus diisi',
      'nav_no.numeric' => 'Urutan menu harus diisi angka',
      'nav_icon.max' => 'Icon menu max 50 karakter',
    ]);

    if($validator->fails()){
      $messages = $validator->errors();
      return redirect('/sistem/menu/create/'.$portal_id)->with('error','Data menu gagal ditambahkan')->withErrors($messages);
    }

    // Create NavID
    $nav_id = NavigationModel::getNewID(array($portal_id));

    if(NavigationModel::create([
      'nav_id' => $nav_id,
      'portal_id' => $portal_id,
      'parent_id' => $request->input('parent_id'),
      'nav_title' => $request->input('nav_title'),
      'nav_desc' => $request->input('nav_desc'),
      'nav_url' => $request->input('nav_url'),
      'nav_no' => $request->input('nav_no'),
      'active_st' => $request->input('active_st'),
      'display_st' => $request->input('display_st'),
      'nav_icon' => $request->input('nav_icon'),
      'mdb' => $this->com_user['user_id']
      ])){
        return redirect('/sistem/menu/create/'.$portal_id)->with('success','Data menu berhasil ditambahkan');
      }

      return redirect('/sistem/menu/create/'.$portal_id)->with('error','Data menu gagal ditambahkan');
    }


    public function edit($portal_id = null, $nav_id = null){
      $this->_set_page_rule('U');

      if(!$portal_id){
        return redirect('/sistem/menu');
      }

      if(!$nav_id){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Data menu tidak ditemukan');
      }

      $this->add_load_style('plugins/select2/css/select2.min.css');
      $this->add_load_js('plugins/select2/js/select2.min.js');

      $result = NavigationModel::where('nav_id', $nav_id)->first();
      if(!$result){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Data menu tidak ditemukan');
      }

      $portal = PortalModel::where('portal_id', $portal_id)->first();
      $rs_nav = $this->_get_menu_selectbox_by_portal($portal_id, 0, "", $result->parent_id);


      return view('Settings.Sistem.Navigation.edit', compact('result','portal','rs_nav'));
    }

    public function update(Request $request, $portal_id = null, $nav_id = null){
      $this->_set_page_rule('U');

      if(!$portal_id){
        return redirect('/sistem/menu');
      }

      if(!$nav_id){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Data menu tidak ditemukan');
      }

      $validator = Validator::make($request->all(), [
        'parent_id' => 'required',
        'nav_title' => 'required|max:50',
        'nav_desc' => 'required|max:100',
        'nav_url' => 'required|max:100|unique:com_menu,nav_url,'.$nav_id.',nav_id',
        'nav_no' => 'required|numeric',
        'nav_icon' => 'max:50',
      ],[
        'parent_id.required' => 'Induk menu harus diisi',
        'nav_title.required' => 'Nama menu harus diisi',
        'nav_title.max' => 'Nama menu max 50 karakter',
        'nav_desc.required' => 'Deskripsi menu harus diisi',
        'nav_desc.max' => 'Deskripsi menu max 100 karakter',
        'nav_url.required' => 'URL menu harus diisi',
        'nav_url.max' => 'URL menu max 100 karakter',
        'nav_url.unique' => 'URL menu sudah digunakan',
        'nav_no.required' => 'Urutan menu harus diisi',
        'nav_no.numeric' => 'Urutan menu harus diisi angka',
        'nav_icon.max' => 'Icon menu max 50 karakter',
      ]);

      if($validator->fails()){
        $messages = $validator->errors();
        return redirect('/sistem/menu/edit/'.$portal_id.'/'.$nav_id)->with('error','Data menu gagal diedit')->withErrors($messages);
      }

      // Create NavID
      $data = NavigationModel::find($nav_id);
      $data->parent_id = $request->input('parent_id');
      $data->nav_title = $request->input('nav_title');
      $data->nav_desc = $request->input('nav_desc');
      $data->nav_url = $request->input('nav_url');
      $data->nav_no = $request->input('nav_no');
      $data->active_st = $request->input('active_st');
      $data->display_st = $request->input('display_st');
      $data->nav_icon = $request->input('nav_icon');
      $data->mdb = $this->com_user['user_id'];

      if($data->save()){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('success','Data menu berhasil diedit');
      }

      return redirect('/sistem/menu/edit/'.$portal_id.'/'.$nav_id)->with('error','Data menu gagal diedit');
    }

    public function delete($portal_id = null, $nav_id = null){
      $this->_set_page_rule('D');

      if(!$portal_id){
        return redirect('/sistem/menu');
      }

      if(!$nav_id){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Data menu tidak ditemukan');
      }

      $child = NavigationModel::where('parent_id', $nav_id)->count();
      if($child > 0){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Menu induk tidak dapat dihapus jika masih mempunyai menu turunan');
      }

      $result = NavigationModel::where('nav_id', $nav_id)->first();
      if(!$result){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Data menu tidak ditemukan');
      }

      $portal = PortalModel::where('portal_id', $portal_id)->first();
      $parent = NavigationModel::find($result->parent_id);

      return view('Settings.Sistem.Navigation.delete', compact('result','portal','parent'));
    }

    public function remove(Request $request, $portal_id = null, $nav_id = null){
      $this->_set_page_rule('D');

      if(!$portal_id){
        return redirect('/sistem/menu');
      }

      if(!$nav_id){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Data menu tidak ditemukan');
      }

      $child = NavigationModel::where('parent_id', $nav_id)->count();
      if($child > 0){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Menu induk tidak dapat dihapus jika masih mempunyai menu turunan');
      }

      if(NavigationModel::where('nav_id',$nav_id)->delete()){
        return redirect('/sistem/menu/navigation/'.$portal_id)->with('success','Data menu berhasil dihapus');
      }

      return redirect('/sistem/menu/navigation/'.$portal_id)->with('error','Data menu gagal dihapus');
    }

    // Internal method
    private function _get_menu_by_portal($portal_id, $parent_id, $indent) {
      $html = "";
      $rs_id = NavigationModel::where('portal_id', $portal_id)
      ->where('parent_id', $parent_id)
      ->orderBy('nav_no', 'ASC')
      ->get();
      $rs_id = $rs_id->toArray();
      if ($rs_id) {
        $no = 0;
        $indent .= "--- ";
        foreach ($rs_id as $rec) {
          // url
          $url_edit = '/sistem/menu/edit/' . $portal_id . '/' . $rec['nav_id'];
          $url_hapus = '/sistem/menu/delete/' . $portal_id . '/' . $rec['nav_id'];
          // icon
          $icon = '';
          if (!empty($rec['nav_icon'])) {
            $icon = '<i class="' . $rec['nav_icon'] . '"></i>';
          }
          // parse
          $html .= "<tr>";
          $html .= "<td class='text-center'>" . $icon . "</td>";
          $html .= "<td>" . $indent . $rec['nav_title'] . "</td>";
          $html .= "<td>" . $rec['nav_url'] . "</td>";
          $html .= "<td class='text-center'>" . $rec['active_st'] . "</td>";
          $html .= "<td class='text-center'>" . $rec['display_st'] . "</td>";
          $html .= "<td class='text-center'>";
          $html .= "<a href='" . $url_edit . "' class='btn btn-xs btn-info mr-5'><i class='fa fa-pencil'></i></a>";
          $html .= "<a href='" . $url_hapus . "' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></a>";
          $html .= "</td>";
          $html .= "</tr>";
          $html .= $this->_get_menu_by_portal($rec['portal_id'], $rec['nav_id'], $indent);
          $no++;
        }
      }
      return $html;
    }

    private function _get_menu_selectbox_by_portal($portal_id, $parent_id, $indent,$parent_selected) {
      $html = "";
      $rs_id = NavigationModel::where('portal_id', $portal_id)
      ->where('parent_id', $parent_id)
      ->orderBy('nav_no', 'ASC')
      ->get();
      $rs_id = $rs_id->toArray();
      if ($rs_id) {
        $no = 0;
        $indent .= "--- ";
        foreach ($rs_id as $rec) {
          // selected
          $selected = ($parent_selected == $rec['nav_id']) ? 'selected="selected"' : '';
          // parse
          $html .= "<option value='" . $rec['nav_id'] . "' " . $selected . ">";
          $html .= $indent . $rec['nav_title'];
          $html .= "</option>";
          $html .= $this->_get_menu_selectbox_by_portal($rec['portal_id'], $rec['nav_id'], $indent, $parent_selected);
        }
      }
      return $html;
    }
  }
