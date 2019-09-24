<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Model
use App\Models\Base\Menu;

class DeveloperBase extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  protected $portal_id = '10';
  protected $role_tp = array();
  protected $com_user = array();
  protected $request;

  public function __construct(Request $request){
    $this->request = $request;
    $this->check_authority();
  }

  protected function check_authority(){
    // default rule tp
    $this->role_tp = array("C" => "0", "R" => "0", "U" => "0", "D" => "0");

    $this->com_user = $this->request->session()->get('login_developer');
    if(!$this->com_user){
      return redirect('/auth/developer');
    }

    $role_tp = Menu::getUserAuthorityByNav(array($this->com_user['user_id'], $this->get_nav_id(), $this->portal_id));

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
      return redirect('/auth/developer/logout')->send();
    }
  }

  private function get_nav_id(){
    $routePrefix = $this->request->route()->getPrefix();

    $nav = Menu::where('nav_url', $routePrefix)->get();
    if($nav->count()){
      $nav = json_decode(json_encode($nav[0]),true);
      return $nav['nav_id'];
    }

    return '';
  }
}
