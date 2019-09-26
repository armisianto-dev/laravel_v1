<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class PermissionsModel extends Model
{
  protected $table = 'com_role_menu';
  protected $primaryKey = ['role_id','nav_id'];
  public $incrementing = false;

  protected $fillable = [
    'role_id','nav_id','role_tp'
  ];

  public $timestamps = false;

  public static function getAll($params){
    $result = DB::table('com_role AS a')
    ->select('a.*','b.group_name')
    ->join('com_group AS b','a.group_id','=','b.group_id')
    ->whereRaw('a.group_id LIKE ? AND a.role_nm LIKE ? ', $params)
    ->orderBy('a.role_id', 'ASC')
    ->paginate(10);
    return $result;
  }

  public static function getAllMenuSelected($params){
    $sql = "SELECT a.*, b.role_id, b.role_tp
    FROM com_menu a
    LEFT JOIN (SELECT * FROM com_role_menu WHERE role_id = ?) b ON a.nav_id = b.nav_id
    WHERE portal_id = ? AND parent_id = ?
    ORDER BY nav_no ASC";

    $result = DB::select($sql, $params);
    return json_decode(json_encode($result), true);
  }
}
