<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use DB;

class Menu extends Model
{
  //
  protected $table = 'com_menu';
  protected $primaryKey = 'nav_id';

  public static function getMenuByParent($portal_id, $user_id, $parent_id): Array {
    $results = DB::table('com_menu AS a')
    ->select('a.*')
    ->join('com_role_menu AS b', 'a.nav_id', '=', 'b.nav_id')
    ->join('com_role_user AS c', 'b.role_id', '=', 'c.role_id')
    ->where('a.portal_id','=',$portal_id)
    ->where('c.user_id','=',$user_id)
    ->where('a.parent_id','=',$parent_id)
    ->where('a.active_st','=','1')
    ->where('a.display_st','=','1')
    ->where('c.role_display','=','1')
    ->groupBy('a.nav_id')
    ->orderBy('a.nav_no', 'ASC')
    ->get();
    return json_decode(json_encode($results), true);
  }

  public static function getUserAuthorityByNav($params){
    $sql = "SELECT DISTINCT b.* FROM com_menu a
    INNER JOIN com_role_menu b ON a.nav_id = b.nav_id
    INNER JOIN com_role c ON b.role_id = c.role_id
    INNER JOIN com_role_user d ON c.role_id = d.role_id
    WHERE d.user_id = ? AND b.nav_id = ? AND a.portal_id = ? AND active_st = '1'";
    
    $result = DB::connection()->select($sql, $params);
    $result = json_decode(json_encode($result), true);
    if($result){
      return $result[0]['role_tp'];
    }else{
      return false;
    }

  }
}
