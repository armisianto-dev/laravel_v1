<?php

namespace App\Http\Controllers\Settings\Sistem;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\DeveloperBase;

use DB;
use App\Models\Settings\Sistem\PermissionsModel;
use App\Models\Settings\Sistem\RolesModel;
use App\Models\Settings\Sistem\PortalModel;
use App\Models\Settings\Sistem\GroupsModel;

class PermissionsController extends DeveloperBase
{

  public function index(Request $request){
    $this->_set_page_rule('R');

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_js('plugins/select2/js/select2.min.js');

    // Set search parameter
    $search = $request->session()->get('session_sistem_permissions');
    $role_nm = empty($search['role_nm']) ? '%' : '%'.$search['role_nm'].'%';
    $group_id = empty($search['group_id']) ? '%' : $search['group_id'];

    $rs_group = GroupsModel::orderBy('group_id')->get();

    $rs_result = PermissionsModel::getAll([$group_id, $role_nm]);
    return view('Settings.Sistem.Permissions.index', compact('rs_result','rs_group','search'));
  }

  public function search(Request $request){
    $this->_set_page_rule('R');

    $search = array();
    $search['role_nm'] = $request->input('role_nm');
    $search['group_id'] = $request->input('group_id');

    $request->session()->put('session_sistem_permissions', $search);
    return redirect('/sistem/permissions');
  }

  public function edit(Request $request, $role_id = null){
    $this->_set_page_rule('U');

    $this->add_load_style('plugins/select2/css/select2.min.css');
    $this->add_load_js('plugins/select2/js/select2.min.js');

    if(!$role_id){
      return redirect('/sistem/permissions')->with('error','Data role tidak ditemukan');
    }

    $result = RolesModel::where('role_id', $role_id)->first();
    if(!$result){
      return redirect('/sistem/permissions')->with('error','Data role tidak ditemukan');
    }

    // Set search parameter
    $search = $request->session()->get('session_sistem_permissions_update');
    $portal = PortalModel::orderBy('portal_id', 'ASC')->first();
    $search['portal_id'] = empty($search['portal_id']) ? $portal->portal_id : $search['portal_id'];

    $rs_portal = PortalModel::orderBy('portal_id')->get();
    $rs_menu = $this->_display_menu($search['portal_id'], $role_id, 0, "");

    return view('Settings.Sistem.Permissions.edit', compact('result', 'role_id','rs_portal','search','rs_menu'));
  }

  public function set_portal(Request $request, $role_id = null){
    $this->_set_page_rule('R');

    $search = array();
    $search['portal_id'] = $request->input('portal_id');

    $request->session()->put('session_sistem_permissions_update', $search);
    return redirect('/sistem/permissions/edit/'.$role_id);
  }

  public function update(Request $request, $role_id = null, $portal_id = null){
    $this->_set_page_rule('U');

    if(!$role_id){
      return redirect('/sistem/permissions')->with('error','Permissions gagal diedit')->withErrors(array('Role ID kosong'));
    }

    if(!$portal_id){
      return redirect('/sistem/permissions/edit/'.$role_id)->with('error','Permissions gagal diedit')->withErrors(array('Portal ID kosong'));
    }

    // Reset com_role_menu
    $com_role_menu = DB::table('com_role_menu AS a')->select('a.*')
    ->join('com_menu AS b','a.nav_id','=','b.nav_id')
    ->where('a.role_id', $role_id)
    ->where('b.portal_id', $portal_id)
    ->delete();

    // insert
    $rules = $request->input('rules');
    if (is_array($rules)) {
      foreach ($rules as $nav => $rule) {
        // get rule tipe
        $role_tp = array("C" => "0", "R" => "0", "U" => "0", "D" => "0");
        $i = 0;
        foreach ($role_tp as $tp => $val) {
          if (isset($rule[$tp])) {
            $role_tp[$tp] = $rule[$tp];
          }
          $i++;
        }
        $result = implode("", $role_tp);
        // insert
        PermissionsModel::create([
          'role_id' => $role_id,
          'nav_id' => $nav,
          'role_tp' => $result
        ]);
      }
    }

    return redirect('/sistem/permissions/edit/'.$role_id)->with('success','Permission berhasil diupdate');
  }

  private function _display_menu($portal_id, $role_id, $parent_id, $indent)
  {
    $html = "";
    // get data
    $params = array($role_id, $portal_id, $parent_id);
    $rs_id = PermissionsModel::getAllMenuSelected($params);
    if (!empty($rs_id)) {
      $no = 0;
      $indent .= "--- ";
      foreach ($rs_id as $rec) {
        $role_tp = array("C" => "0", "R" => "0", "U" => "0", "D" => "0");
        $i = 0;
        foreach ($role_tp as $rule => $val) {
          $N = substr($rec['role_tp'], $i, 1);
          $role_tp[$rule] = $N;
          $i++;
        }
        $checked = "";
        if (array_sum($role_tp) > 0) {
          $checked = "checked='true'";
        }
        // parse
        $html .= "<tr>";
        $html .= "<td class='text-center'>";
        $html .= '<div class="checkbox"><input type="checkbox" id="' . $rec['nav_id'] . '" class="magic-checkbox checked-all r-menu" value="' . $rec['nav_id'] . '" ' . $checked . '><label for="' . $rec['nav_id'] . '"></label> </div>';
        $html .= "</td>";
        $html .= "<td><label for='" . $rec['nav_id'] . "'>" . $indent . $rec['nav_title'] . "</label><br><small class='text-danger'>" . $rec['nav_url'] . "</small></td>";
        $html .= "";
        $html .= '<td class="text-center"><div class="checkbox"><input type="checkbox" id="c-' . $rec['nav_id'] . '" class="magic-checkbox r' . $rec['nav_id'] . ' r-menu" name="rules[' . $rec['nav_id'] . '][C]" value="1" ' . ($role_tp['C'] == "1" ? 'checked ="true"' : "") . '><label for="c-' . $rec['nav_id'] . '"></label></div></td>';
        $html .= '<td class="text-center"><div class="checkbox"><input type="checkbox" id="r-' . $rec['nav_id'] . '" class="magic-checkbox r' . $rec['nav_id'] . ' r-menu" name="rules[' . $rec['nav_id'] . '][R]" value="1" ' . ($role_tp['R'] == "1" ? 'checked ="true"' : "") . '><label for="r-' . $rec['nav_id'] . '"></label></div></td>';
        $html .= '<td class="text-center"><div class="checkbox"><input type="checkbox" id="u-' . $rec['nav_id'] . '" class="magic-checkbox r' . $rec['nav_id'] . ' r-menu" name="rules[' . $rec['nav_id'] . '][U]" value="1" ' . ($role_tp['U'] == "1" ? 'checked ="true"' : "") . '><label for="u-' . $rec['nav_id'] . '"></label></div></td>';
        $html .= '<td class="text-center"><div class="checkbox"><input type="checkbox" id="d-' . $rec['nav_id'] . '" class="magic-checkbox r' . $rec['nav_id'] . ' r-menu" name="rules[' . $rec['nav_id'] . '][D]" value="1" ' . ($role_tp['D'] == "1" ? 'checked ="true"' : "") . '><label for="d-' . $rec['nav_id'] . '"></label></div></td>';
        $html .= "</tr>";
        $html .= $this->_display_menu($portal_id, $role_id, $rec['nav_id'], $indent);
        $no++;
      }
    }
    return $html;
  }

}
