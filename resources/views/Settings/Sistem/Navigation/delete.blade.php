@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Navigation</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li><a href="/sistem/menu">Navigation</a></li>
  <li><a href="/sistem/menu/navigation/{{ $portal->portal_id }}">{{ $portal->portal_nm }}</a></li>
  <li class="active">Hapus Data</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/menu/navigation/{{ $portal->portal_id }}" class="btn btn-warning">
                <i class="fa fa-chevron-left mr-5"></i> Kembali
              </a>
            </div>
            <h3 class="panel-title">Hapus Data</h3>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/menu/remove/{{ $portal->portal_id }}/{{ $result->nav_id }}" method="post">
            <div class="panel-body">
              @include('includes.flash-message')
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-lg-12">
                  <p class="form-label-static text-danger">Apakah anda yakin akan menghapus data berikut ?</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Induk Menu</label>
                <div class="col-md-7">
                  <p class="orm-label-static">: {{ ($result->parent_id == "0") ? "*" : $parent->nav_title }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Judul Menu</label>
                <div class="col-md-7">
                  <p class="orm-label-static">: {{ $result->nav_title }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Deskripsi</label>
                <div class="col-md-7">
                  <p class="orm-label-static">: {{ $result->nav_desc }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">URL</label>
                <div class="col-md-7">
                  <p class="orm-label-static">: <code>{{ $result->nav_url }}</code></p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Urutan</label>
                <div class="col-md-3">
                  <p class="orm-label-static">: {{ $result->nav_no }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Digunakan</label>
                <div class="col-md-9">
                  <p class="orm-label-static">: {{ ($result->active_st == "1") ? "Ya" : "Tidak" }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Ditampilkan</label>
                <div class="col-md-9">
                  <p class="orm-label-static">: {{ ($result->display_st == "1") ? "Ya" : "Tidak" }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Icon</label>
                <div class="col-md-6">
                  <p class="orm-label-static">:  <i class="{{ $result->nav_icon }}"></i> </p>
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
