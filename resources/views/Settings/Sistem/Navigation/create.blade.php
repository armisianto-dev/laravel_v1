@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Navigation</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li><a href="/sistem/menu">Navigation</a></li>
  <li><a href="/sistem/menu/navigation/{{ $portal->portal_id }}">{{ $portal->portal_nm }}</a></li>
  <li class="active">Tambah Data</li>
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
            <h3 class="panel-title">Tambah Data</h3>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/menu/insert/{{ $portal->portal_id }}" method="post">
            <div class="panel-body">
              @include('includes.flash-message')
              {{ csrf_field() }}
              <div class="form-group">
                <label class="col-md-3 control-label">Induk Menu</label>
                <div class="col-md-7">
                  <select class="form-control" name="parent_id" id="parent_id" data-placeholder="Pilih Induk Menu">
                    <option value="0">*</option>
                    {!! $rs_nav !!}
                  </select>
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Judul Menu</label>
                <div class="col-md-7">
                  <input type="text" class="form-control" name="nav_title" maxlength="50" value="">
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Deskripsi</label>
                <div class="col-md-7">
                  <textarea name="nav_desc" rows="4" class="form-control" maxlength="100"></textarea>
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">URL</label>
                <div class="col-md-7">
                  <input type="text" class="form-control" name="nav_url" maxlength="100" value="">
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Urutan</label>
                <div class="col-md-3">
                  <input type="number" class="form-control" name="nav_no" maxlength="11" value="">
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Digunakan</label>
                <div class="col-md-9">
                  <div class="radio">
                    <input id="active-st-ya" class="magic-radio" name="active_st" type="radio" checked="" value="1">
                    <label for="active-st-ya">Ya</label>
                    <input id="active-st-tidak" class="magic-radio" name="active_st" type="radio" value="0">
                    <label for="active-st-tidak">Tidak</label>
                  </div>
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Ditampilkan</label>
                <div class="col-md-9">
                  <div class="radio">
                    <input id="display-st-ya" class="magic-radio" name="display_st" type="radio" checked="" value="1">
                    <label for="display-st-ya">Ya</label>
                    <input id="display-st-tidak" class="magic-radio" name="display_st" type="radio" value="0">
                    <label for="display-st-tidak">Tidak</label>
                  </div>
                  <small class="help-block text-danger">Wajib diisi.</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Icon</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="nav_icon" maxlength="50" value="">
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
