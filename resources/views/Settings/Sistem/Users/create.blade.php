@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Users</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li ><a href="/sistem/users">Users</a></li>
  <li class="active">Tambah Data</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/users" class="btn btn-info">
                <i class="fa fa-chevron-left mr-5"></i> Kembali
              </a>
            </div>
            <h3 class="panel-title">Tambah Data</h3>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/users/insert" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
              @include('includes.flash-message')
              <div class="form-group">
                <label class="col-md-3 control-label">Role</label>
                <div class="col-md-7">
                  <select class="form-control" name="role_id" id="role_id" data-placeholder="Pilih Role">
                    <option value=""></option>
                    @if (count($rs_role) > 0)
                      @foreach ($rs_role as $role)
                      <option value="{{ str_pad($role->role_id,5,'0',STR_PAD_LEFT) }}">{{ $role->role_nm }}</option>
                      @endforeach
                    @endif
                  </select>
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Nama</label>
                <div class="col-md-7">
                  <input type="text" name="user_alias" maxlength="50" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-7">
                  <input type="text" name="user_mail" maxlength="50" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Password</label>
                <div class="col-md-7">
                  <input type="password" name="user_pass" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi. Minimal 6 karakter</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Konfirmasi Password</label>
                <div class="col-md-7">
                  <input type="password" name="user_pass_confirm" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Foto Profil</label>
                <div class="col-md-7">
                  
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
