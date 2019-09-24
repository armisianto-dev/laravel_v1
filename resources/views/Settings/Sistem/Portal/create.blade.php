@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Portal</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li ><a href="/sistem/portal">Portal</a></li>
  <li class="active">Tambah Data</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/portal" class="btn btn-info">
                <i class="fa fa-chevron-left mr-5"></i> Kembali
              </a>
            </div>
            <h3 class="panel-title">Tambah Data</h3>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/portal/insert" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
              @include('includes.flash-message')
              <div class="form-group">
                <label class="col-md-3 control-label">ID Portal</label>
                <div class="col-md-7">
                  <input type="text" name="portal_id" maxlength="2" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Nama Portal</label>
                <div class="col-md-7">
                  <input type="text" name="portal_nm" maxlength="50" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Site Title</label>
                <div class="col-md-7">
                  <input type="text" name="site_title" maxlength="100" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Site Desc</label>
                <div class="col-md-7">
                  <input type="text" name="site_desc" maxlength="100" value="" class="form-control" />
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Meta Desc</label>
                <div class="col-md-7">
                  <textarea name="meta_desc" rows="4" class="form-control" maxlength="255"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Meta Keyword</label>
                <div class="col-md-7">
                  <textarea name="meta_keyword" rows="4" class="form-control" maxlength="255"></textarea>
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
@endsection
