<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Repositories\UserRepository;

// Model
use App\Models\Base\Menu;

class OperatorComposer
{

  protected $portal_id = '20';
  protected $nav_id = 0;
  protected $parent_id = 0;
  protected $parent_selected = 0;

  public function compose(View $view)
  {
    $list_menu = $this->__display_navigation();
    $view->with('list_menu', $list_menu);
  }

  protected function __set_parent(){
    $routeName = Route::currentRouteName();
    $nav = Menu::where('nav_url', $routeName)->get();
    $this->parent_selected = $nav->parent_id;
  }

  protected function __get_parent(){
    return $this->parent_selected;
  }

  protected function __display_navigation()
  {
    $html = "";
    $html .= "<li class='list-header'>Navigation</li>";
    // get data
    $rs_id = Menu::getMenuByParent($this->portal_id, '1909160002', 0);

    if (!empty($rs_id)) {
      foreach ($rs_id as $rec) {
        // parent active
        $parent_class = '';
        $parent_active = '';
        // $this->parent_selected = self::_get_parent_group($this->parent_id, 0);
        // if ($this->parent_selected == 0) {
        //     $this->parent_selected = $this->nav_id;
        // }

        // get child navigation
        $child = $this->_get_child_navigation($rec['nav_id']);
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
    return $html;
    // return view('includes.header', compact('html'));
  }

  protected function _get_child_navigation($parent_id)
  {
    $html = "";
    $parent_selected = $this->parent_selected;
    // get parent selected
    // $parent_selected = self::_get_parent_group($this->parent_id, $parent_id);
    // if ($parent_selected == 0) {
    //     $parent_selected = $this->nav_id;
    // }
    // --
    $rs_id = Menu::getMenuByParent($this->portal_id, '1909160002', $parent_id);

    if (!empty($rs_id)) {
      $collapse = ($parent_id == $this->parent_selected) ? 'collapse in' : 'collapse' ;
      $html = '<ul class="'.$collapse.'">';
      foreach ($rs_id as $rec) {
        // selected
        $selected = ($rec['nav_id'] == $parent_selected) ? 'class="active-link"' : "";
        // parse
        $html .= '<li ' . $selected . '>';
        $html .= '<a href="' . url("/".$rec['nav_url']) . '" title="' . $rec['nav_desc'] . '">';
        $html .= $rec['nav_title'];
        $html .= '</a>';
        $html .= '</li>';
      }
      $html .= '</ul>';
    }
    return $html;
  }
}
