@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Roles</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li ><a href="/sistem/roles">Roles</a></li>
  <li class="active">Delete Data</li>
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
            <h3 class="panel-title">Delete Data</h3>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/roles/remove/{{ str_pad($result->role_id,5,'0',STR_PAD_LEFT) }}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
              @include('includes.flash-message')
              <div class="form-group">
                <div class="col-lg-12">
                  <p class="form-label-static text-danger">Apakah anda yakin akan menghapus data berikut ?</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">ID Roles</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ str_pad($result->role_id,5,'0',STR_PAD_LEFT) }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Nama Role</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ $result->role_nm }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Role Desc</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ $result->role_desc }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Default Page</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ $result->default_page }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Group</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ $group->group_name }}</p>
                </div>
              </div>
            </div>
            <div class="panel-footer text-right">
              <button type="submit" name="button" class="btn btn-sm btn-danger">
                <i class="fa fa-times"></i> Hapus
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
