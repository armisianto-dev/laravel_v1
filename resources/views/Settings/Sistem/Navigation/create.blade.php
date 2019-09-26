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
            <h3 class="panel-title">List Navigation</h3>
          </div>
          <form class="form-inline" action="/sistem/menu/search/{{ $portal->portal_id }}" method="post">
            <div class="panel-body">
              {{ csrf_field() }}
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
