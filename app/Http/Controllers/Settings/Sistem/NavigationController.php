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

    return view('Settings.Sistem.Navigation.create', compact('portal','search','rs_nav','rs_parent'));
  }

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
}
