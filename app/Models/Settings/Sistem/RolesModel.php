<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class RolesModel extends Model
{
  protected $table = 'com_role';
  protected $primaryKey = 'role_id';

  protected $fillable = [
    'role_id','group_id','role_nm','role_desc','default_page','mdb'
  ];

  const CREATED_AT = 'crd';
  const UPDATED_AT = 'mdd';

  public static function getAll($params){
    $result = DB::table('com_role AS a')
    ->select('a.*','b.group_name')
    ->join('com_group AS b','a.group_id','=','b.group_id')
    ->whereRaw('a.group_id LIKE ? AND a.role_nm LIKE ? ', $params)
    ->orderBy('a.role_id', 'ASC')
    ->paginate(10);
    return $result;
  }

  public static function getNewID($params){
    $sql = "SELECT RIGHT(role_id,3) AS 'last_id'
    FROM com_role
    WHERE group_id = ?
    ORDER BY role_id DESC LIMIT 1 ";

    $results = DB::connection()->select($sql, $params);
    if(count($results) > 0){
      $result = $results[0];
      $last_id = intval($result->last_id);
      return $params[0].STR_PAD(($last_id+1),3,'0',STR_PAD_LEFT);
    }else{
      return $params[0].'001';
    }
  }
}
