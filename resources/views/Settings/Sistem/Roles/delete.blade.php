@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Groups</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li ><a href="/sistem/groups">Groups</a></li>
  <li class="active">Delete Data</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/groups" class="btn btn-info">
                <i class="fa fa-chevron-left mr-5"></i> Kembali
              </a>
            </div>
            <h3 class="panel-title">Delete Data</h3>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/groups/remove/{{ str_pad($group_id,2,'0',STR_PAD_LEFT) }}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
              @include('includes.flash-message')
              <div class="form-group">
                <div class="col-lg-12">
                  <p class="form-label-static text-danger">Apakah anda yakin akan menghapus data berikut ?</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">ID Groups</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ $result->group_id }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Nama Groups</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ $result->group_name }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Group Desc</label>
                <div class="col-md-7">
                  <p class="form-label-static">: {{ $result->group_desc }}</p>
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
