@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Roles</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li ><a href="/sistem/roles">Roles</a></li>
  <li class="active">Edit Data</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/roles" class="btn btn-info">
                <i class="fa fa-chevron-left mr-5"></i> Kembali
              </a>
            </div>
            <h3 class="panel-title">Tambah Data</h3>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/roles/update/{{ str_pad($result->role_id,5,'0',STR_PAD_LEFT) }}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
              @include('includes.flash-message')
              <div class="form-group">
                <label class="col-md-3 control-label">Group</label>
                <div class="col-md-7">
                  <select class="form-control" name="group_id" id="group_id" data-placeholder="Pilih Group">
                    <option value=""></option>
                    @if (count($rs_group) > 0)
                      @foreach ($rs_group as $group)
                      <option value="{{ str_pad($group->group_id,2,'0',STR_PAD_LEFT) }}" @if (str_pad($group->group_id,2,'0',STR_PAD_LEFT) == str_pad($result->group_id,2,'0',STR_PAD_LEFT)) selected="" @endif>{{ $group->group_name }}</option>
                      @endforeach
                    @endif
                  </select>
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Nama Roles</label>
                <div class="col-md-7">
                  <input type="text" name="role_nm" maxlength="100" value="{{ $result->role_nm }}" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Role Desc</label>
                <div class="col-md-7">
                  <textarea name="role_desc" rows="4" class="form-control" maxlength="100">{{ $result->role_desc }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Default Page</label>
                <div class="col-md-7">
                  <input type="text" name="default_page" maxlength="50" value="{{ $result->default_page }}" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
            </div>
            <div class="panel-footer text-right">
              <button type="reset" name="button" class="btn btn-sm btn-danger">
                <i class="fa fa-times"></i> Reset
              </button>
              <button type="submit" name="button" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("select").select2({
    allowClear: true
  });
})
</script>
@endsection
