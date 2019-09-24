<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Model
use App\Models\Base\Menu;

class OperatorBase extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  protected $portal_id = '10';
  protected $nav_id = 0;
  protected $parent_id = 0;
  protected $parent_selected = 0;

  public function __construct()
  {
  }

  public function __display_navigation()
  {
    $html = "";
    $html .= "<li class='list-header'>Navigation</li>";
    // get data
    $rs_id = Menu::getMenuByParent($this->portal_id, '1804170001', 0);

    if ($rs_id) {
      foreach ($rs_id as $rec) {
        // parent active
        $parent_class = '';
        $parent_active = '';
        // $this->parent_selected = self::_get_parent_group($this->parent_id, 0);
        // if ($this->parent_selected == 0) {
        //     $this->parent_selected = $this->nav_id;
        // }

        // get child navigation
        $child = $this->_get_child_navigation($rec->nav_id);
        if (!empty($child)) {
          $parent_class = '';
          $url_parent = '#';
          $arrow = '<i class="arrow"></i>';
        } else {
          $url_parent = '';
          $url_parent = url($rec->nav_url);
          $arrow = '';
        }
        // parent active
        if ($this->parent_selected == $rec->nav_id) {
          if (!empty($child)) {
            $parent_active = 'active-sub';
          } else {
            $parent_active = 'active-link';
          }
        }
        // data
        $html .= '<li class="' . $parent_class . ' ' . $parent_active . '">';
        $html .= '<a href="' . $url_parent . '"><i class="' . $rec->nav_icon . '"></i> <span class="menu-title">' . $rec->nav_title . '</span>'.$arrow.'</a>';
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
    $rs_id = Menu::getMenuByParent($this->portal_id, '1804170001', $parent_id);

    if (!empty($rs_id)) {
      $collapse = ($parent_id == $this->parent_selected) ? 'collapse in' : 'collapse' ;
      $html = '<ul class="'.$collapse.'">';
      foreach ($rs_id as $rec) {
        // selected
        $selected = ($rec->nav_id == $parent_selected) ? 'class="active-link"' : "";
        // parse
        $html .= '<li ' . $selected . '>';
        $html .= '<a href="' . url("/".$rec->nav_url) . '" title="' . $rec->nav_desc . '">';
        $html .= $rec->nav_title;
        $html .= '</a>';
        $html .= '</li>';
      }
      $html .= '</ul>';
    }
    return $html;
  }
}
