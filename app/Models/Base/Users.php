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
    $sql = "SELECT a.*, c.*, IF(a.user_img_name IS NOT NULL OR a.user_img_name != '', CONCAT(a.user_img_path, a.user_img_name), CONCAT('storage/images/users/default.png')) AS 'user_image'
    FROM com_user a
    INNER JOIN com_role_user b ON a.user_id = b.user_id
    INNER JOIN com_role c ON b.role_id = c.role_id
    WHERE a.user_name = ?
    GROUP BY a.user_id ";

    $result = DB::connection()->select($sql, $params);
    return json_decode(json_encode($result), true);
  }

  public static function getUserLoginByID($params){
    $sql = "SELECT a.*, c.*, IF(a.user_img_name IS NOT NULL OR a.user_img_name != '', CONCAT(a.user_img_path, a.user_img_name), CONCAT('storage/images/users/default.png')) AS 'user_image'
    FROM com_user a
    INNER JOIN com_role_user b ON a.user_id = b.user_id
    INNER JOIN com_role c ON b.role_id = c.role_id
    WHERE a.user_id = ?
    GROUP BY a.user_id ";

    $result = DB::connection()->select($sql, $params);
    return json_decode(json_encode($result[0]), true);
  }
}
