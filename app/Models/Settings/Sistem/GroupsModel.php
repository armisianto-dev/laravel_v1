<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupsModel extends Model
{
  protected $table = 'com_group';
  protected $primaryKey = 'group_id';

  protected $fillable = [
    'group_id','group_name', 'group_desc','mdb'
  ];

  protected $cast = [
    'group_id' => 'real'
  ];

  const CREATED_AT = 'crd';
  const UPDATED_AT = 'mdd';
}
