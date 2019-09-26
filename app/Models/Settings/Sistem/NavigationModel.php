<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class NavigationModel extends Model
{
  protected $table = 'com_menu';
  protected $primaryKey = 'nav_id';

  protected $fillable = [
    'nav_id','portal_id','parent_id', 'nav_title', 'nav_desc', 'nav_url','nav_no','active_st','display_st','nav_icon','mdb'
  ];

  const CREATED_AT = 'crd';
  const UPDATED_AT = 'mdd';

  public static function getAll(){
    $result = DB::table('com_portal AS a')
      ->leftJoin('com_menu AS b','a.portal_id','=','b.portal_id')
      ->selectRaw('a.*, COUNT(b.nav_id) AS jumlah_menu')
      ->groupBy('a.portal_id')
      ->orderBy('a.portal_id', 'ASC')
      ->paginate(10);

    return $result;
  }

  public static function getNewID($params){
    $sql = "SELECT RIGHT(nav_id,8) AS 'last_id'
    FROM com_menu
    WHERE portal_id = ?
    ORDER BY nav_id DESC LIMIT 1 ";

    $results = DB::connection()->select($sql, $params);
    if(count($results) > 0){
      $result = $results[0];
      $last_id = intval($result->last_id);
      return $params[0].STR_PAD(($last_id+1),8,'0',STR_PAD_LEFT);
    }else{
      return $params[0].STR_PAD('1',8,'0',STR_PAD_LEFT);
    }
  }
}
