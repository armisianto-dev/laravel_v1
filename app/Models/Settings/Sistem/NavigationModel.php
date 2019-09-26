<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class NavigationModel extends Model
{
  protected $table = 'com_menu';
  protected $primaryKey = 'nav_id';

  protected $fillable = [
    'portal_id','parent_id', 'nav_title', 'nav_desc', 'nav_url','nav_no','active_st','display_st','nav_icon','mdb'
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
}
