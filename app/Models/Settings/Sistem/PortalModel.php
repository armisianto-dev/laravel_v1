<?php

namespace App\Models\Settings\Sistem;

use Illuminate\Database\Eloquent\Model;
use DB;

class PortalModel extends Model
{
  protected $table = 'com_portal';
  protected $primaryKey = 'portal_id';

  protected $fillable = [
    'portal_id','portal_nm', 'site_title', 'site_desc', 'meta_desc','meta_keyword','mdb'
  ];

  const CREATED_AT = 'crd';
  const UPDATED_AT = 'mdd';
}
