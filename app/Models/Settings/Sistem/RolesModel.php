<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class RolesModel extends Model
{
  protected $table = 'com_role';
  protected $primaryKey = 'role_id';

  protected $fillable = [
    'role_id','role_nm','role_desc','default_page','mdb'
  ];

  const CREATED_AT = 'crd';
  const UPDATED_AT = 'mdd';
}
