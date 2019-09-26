@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Navigation</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li><a href="/sistem/menu">Navigation</a></li>
  <li class="active">{{ $portal->portal_nm }}</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/menu" class="btn btn-warning">
                <i class="fa fa-chevron-left mr-5"></i> Kembali
              </a>
              <a href="/sistem/menu/create/{{ $portal->portal_id }}" class="btn btn-info">
                <i class="fa fa-plus mr-5"></i> Tambah Data
              </a>
            </div>
            <h3 class="panel-title">List Navigation</h3>
          </div>
          <div class="panel-body">
            <form class="form-inline" action="/sistem/menu/search/{{ $portal->portal_id }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="parent_id" class="sr-only">Parent Menu</label>
                <select class="form-control" name="parent_id" id="parent_id" data-placeholder="Pilih Parent">
                  <option value=""></option>
                  @if (count($rs_parent) > 0)
                    @foreach ($rs_parent as $parent)
                    <option value="{{ $parent->nav_id }}" @if ($parent->nav_id == $search['parent_id']) selected="" @endif >{{ $parent->nav_title }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Cari</button>
            </form>
          </div>
          <div class="panel-body">
            @include('includes.flash-message')
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width='5%' class="text-center"></th>
                    <th width='35%' class="text-center">Judul Menu</th>
                    <th width='30%' class="text-center">Alamat</th>
                    <th width='10%' class="text-center">Digunakan</th>
                    <th width='10%' class="text-center">Ditampilkan</th>
                    <th width='10%' class="text-center"></th>
                  </tr>
                </thead>
                <tbody>
                  {!! $rs_nav !!}
                </tbody>
              </table>
            </div>
          </div>
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
