@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Permissions</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li ><a href="/sistem/permissions">Permissions</a></li>
  <li class="active">Edit Permissions</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/permissions" class="btn btn-info">
                <i class="fa fa-chevron-left mr-5"></i> Kembali
              </a>
            </div>
            <h3 class="panel-title">{{ $result->role_nm }}</h3>
          </div>
          <div class="panel-body">
            <form class="form-inline" action="/sistem/permissions/set_portal/{{ str_pad($result->role_id,5,'0',STR_PAD_LEFT) }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="group_id" class="sr-only">Portal</label>
                <select class="form-control" name="portal_id" id="portal_id" data-placeholder="Pilih Portal">
                  <option value=""></option>
                  @if (count($rs_portal) > 0)
                    @foreach ($rs_portal as $portal)
                    <option value="{{ $portal->portal_id }}" @if ($portal->portal_id == $search['portal_id']) selected="" @endif >{{ $portal->portal_nm }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Cari</button>
            </form>
          </div>
          <form class="form-horizontal mar-top" action="/sistem/permissions/update/{{ str_pad($result->role_id,5,'0',STR_PAD_LEFT) }}/{{ $search['portal_id'] }}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
              @include('includes.flash-message')
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width='5%' class="text-center">
                        <div class="checkbox">
                          <input type="checkbox" id="checked-all-menu" class="magic-checkbox checked-all-menu">
                          <label for="checked-all-menu"></label>
                        </div>
                      </th>
                      <th width='55%' class="text-center">Judul Menu</th>
                      <th width='10%' class="text-center">Create</th>
                      <th width='10%' class="text-center">Read</th>
                      <th width='10%' class="text-center">Update</th>
                      <th width='10%' class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    {!! $rs_menu !!}
                  </tbody>
                </table>
              </div>
            </div>
            <div class="panel-footer text-right">
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
  $(".checked-all").click(function () {
    var status = $(this).is(":checked");
    if (status === true) {
      $(".r" + $(this).val()).prop('checked', true);
    } else {
      $(".r" + $(this).val()).prop('checked', false);
    }
  });
  $(".checked-all-menu").click(function () {
    var status = $(this).is(":checked");
    if (status === true) {
      $(".r-menu").prop('checked', true);
    } else {
      $(".r-menu").prop('checked', false);
    }
  });
})
</script>
@endsection
