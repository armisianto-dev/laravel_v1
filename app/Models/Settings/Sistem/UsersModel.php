<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class UsersModel extends Model
{
  protected $table = 'com_user';
  protected $primaryKey = 'user_id';

  protected $fillable = [
    'user_id','user_alias','user_name','user_pass','user_key','user_mail','user_img_name','user_img_path','user_st','user_completed','mdb'
  ];

  const CREATED_AT = 'crd';
  const UPDATED_AT = 'mdd';

  public static function getAll($params){
    $result = DB::table('com_user AS a')
    ->join('com_role_user AS b','a.user_id','=','b.user_id')
    ->join('com_role AS c','b.role_id','=','c.role_id')
    ->select('a.*','b.role_id','c.role_nm')
    ->whereRaw('(a.user_name LIKE ? OR a.user_mail LIKE ?) AND b.role_id LIKE ? ', $params)
    ->orderBy('a.user_id', 'ASC')
    ->paginate(10);

    return $result;
  }

  public static function getDetail($user_id){
    $result = DB::table('com_user AS a')
    ->join('com_role_user AS b','a.user_id','=','b.user_id')
    ->join('com_role AS c','b.role_id','=','c.role_id')
    ->select('a.*','b.role_id','c.role_nm')
    ->where('a.user_id', $user_id)->first();
    return $result;
  }

  public static function getNewID($params){
    $sql = "SELECT RIGHT(user_id,4) AS 'last_id'
    FROM com_user
    WHERE LEFT(user_id, 6) = ?
    ORDER BY user_id DESC LIMIT 1 ";

    $results = DB::connection()->select($sql, $params);
    if(count($results) > 0){
      $result = $results[0];
      $last_id = intval($result->last_id);
      return $params[0].STR_PAD(($last_id+1),4,'0',STR_PAD_LEFT);
    }else{
      return $params[0].'0001';
    }
  }
}
