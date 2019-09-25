<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

// Model
use App\Models\Base\Menu;

class DeveloperBase extends Controller
{
  protected $portal_id = '10';
  protected $role_tp = array();
  protected $request;

  protected $nav_id = 0;
  protected $parent_id = 0;
  protected $parent_selected = 0;
  protected $com_user = array();
  protected $list_nav = '';

  protected $load_js = array();
  protected $load_style = array();

  public function __construct(){
    $this->middleware(function ($request, $next) {
      $this->com_user = $request->session()->get('login_developer');
      $this->__set_current();
      $this->__check_authority();
      $this->__display_navigation();

      View::share('com_user', $this->com_user);
      View::share('list_nav', $this->list_nav);

      View::share('load_js', $this->load_js);
      View::share('load_style', $this->load_style);

      return $next($request);
    });

  }

  protected function __check_authority(){
    // default rule tp
    $this->role_tp = array("C" => "0", "R" => "0", "U" => "0", "D" => "0");

    if(!$this->com_user){
      return redirect('/auth/developer');
    }

    $role_tp = Menu::getUserAuthorityByNav(array($this->com_user['user_id'], $this->nav_id, $this->portal_id));

    // get rule tp
    $i = 0;
    foreach ($this->role_tp as $rule => $val) {
      $N = substr($role_tp, $i, 1);
      $this->role_tp[$rule] = $N;
      $i++;
    }
  }

  public function _set_page_rule($rule) {
    if (!isset($this->role_tp[$rule]) or $this->role_tp[$rule] != "1") {
      // redirect to forbiden access
      return redirect('/auth/developer')->with('error','Logout : Anda tidak mempunyai hak akses')->send();
    }
  }

  public function add_load_js($path){
    $themes_path = 'assets/themes/default/';
    array_push($this->load_js, $themes_path.$path);

    View::share('load_js', $this->load_js);
  }

  public function add_load_style($path){
    $themes_path = 'assets/themes/default/';
    array_push($this->load_style, $themes_path.$path);

    View::share('load_style', $this->load_style);
  }

  // Generate Navigation
  protected function __set_current(){
    $request = Request();
    $routePrefix = $request->route()->getPrefix();

    $nav = Menu::where('nav_url', $routePrefix)->get();
    if($nav->count()){
      $nav = json_decode(json_encode($nav[0]),true);
      $this->parent_selected = $nav['parent_id'];
      $this->parent_id = $nav['parent_id'];
      $this->nav_id = $nav['nav_id'];
    }
  }

  protected function __get_parent(){
    return $this->parent_selected;
  }

  protected function __display_navigation(){
    $html = "";
    $html .= "<li class='list-header'>Navigation</li>";
    // get data
    $rs_id = Menu::getMenuByParent($this->portal_id, $this->com_user['user_id'], 0);

    if (!empty($rs_id)) {
      foreach ($rs_id as $rec) {
        // parent active
        $parent_class = '';
        $parent_active = '';

        // get child navigation
        $child = $this->_get_child_navigation($rec['nav_id'], $this->com_user['user_id']);
        if (!empty($child)) {
          $parent_class = '';
          $url_parent = '#';
          $arrow = '<i class="arrow"></i>';
        } else {
          $parent_class = '';
          $url_parent = url($rec['nav_url']);
          $arrow = '';
        }
        // parent active
        if ($this->parent_selected == $rec['nav_id']) {
          if (!empty($child)) {
            $parent_active = 'active-sub';
          } else {
            $parent_active = 'active-link';
          }
        }
        // data
        $html .= '<li class="' . $parent_class . ' ' . $parent_active . '">';
        $html .= '<a href="' . $url_parent . '"><i class="' . $rec['nav_icon'] . '"></i> <span class="menu-title">' . $rec['nav_title'] . '</span>'.$arrow.'</a>';
        $html .= $child;
        $html .= '</li>';
      }
    }
    // output
    $this->list_nav = $html;
    // return view('includes.header', compact('html'));
  }

  protected function _get_child_navigation($parent_id, $user_id)
  {
    $html = "";
    $parent_selected = $this->parent_selected;
    $nav_id = $this->nav_id;
    // --
    $rs_id = Menu::getMenuByParent($this->portal_id, $user_id, $parent_id);

    if (!empty($rs_id)) {
      $collapse = ($parent_id == $this->parent_selected) ? 'collapse in' : 'collapse' ;
      $html = '<ul class="'.$collapse.'">';
      foreach ($rs_id as $rec) {
        // selected
        $selected = ($rec['nav_id'] == $nav_id) ? 'class="active-link"' : "";
        // parse
        $html .= '<li ' . $selected . '>';
        $html .= '<a href="' . url($rec['nav_url']) . '" title="' . $rec['nav_desc'] . '">';
        $html .= $rec['nav_title'];
        $html .= '</a>';
        $html .= '</li>';
      }
      $html .= '</ul>';
    }
    return $html;
  }
}
