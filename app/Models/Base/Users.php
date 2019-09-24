<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model
{
  //
  protected $table = 'com_user';
  protected $primaryKey = 'user_id';

  public static function getUserLogin($params){
    $sql = "SELECT a.*, c.*
    FROM com_user a
    INNER JOIN com_role_user b ON a.user_id = b.user_id
    INNER JOIN com_role c ON b.role_id = c.role_id
    WHERE a.user_name = ? AND b.role_id = ? ";

    $result = DB::connection()->select($sql, $params);
    return json_decode(json_encode($result), true);
  }
}
