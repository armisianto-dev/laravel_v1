@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Roles</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li class="active">Permissions</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">List Roles</h3>
          </div>
          <div class="panel-body">
            <form class="form-inline" action="/sistem/permissions/search" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="role_nm" class="sr-only">Nama Role</label>
                <input type="text" name="role_nm" placeholder="Nama Role" id="role_nm" class="form-control" value="{{ $search['role_nm'] }}">
              </div>
              <div class="form-group">
                <label for="group_id" class="sr-only">Group</label>
                <select class="form-control" name="group_id" id="group_id" data-placeholder="Pilih Group">
                  <option value=""></option>
                  @if (count($rs_group) > 0)
                    @foreach ($rs_group as $group)
                    <option value="{{ str_pad($group->group_id,2,'0',STR_PAD_LEFT) }}" @if (str_pad($group->group_id,2,'0',STR_PAD_LEFT) == str_pad($search['group_id'],2,'0',STR_PAD_LEFT)) selected="" @endif >{{ $group->group_name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Cari</button>
            </form>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            @include('includes.flash-message')
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="10%" class="text-center">ID Roles</th>
                    <th width="15%" class="text-left">Nama Roles</th>
                    <th width="25%" class="text-left">Roles Desc</th>
                    <th width="20%" class="text-left">Default Page</th>
                    <th width="15%" class="text-left">Group</th>
                    <th width="10%" class="text-center">#</th>
                  </tr>
                </thead>
                <tbody>
                  @if($rs_result->count())
                  @foreach($rs_result as $i=>$result)
                  <tr>
                    <td class="text-center">{{ $rs_result->firstItem()+$i }}</td>
                    <td class="text-center">{{ str_pad($result->role_id,5,'0',STR_PAD_LEFT) }}</td>
                    <td class="text-left">{{ $result->role_nm }}</td>
                    <td class="text-left">{{ $result->role_desc }}</td>
                    <td class="text-left">{{ $result->default_page }}</td>
                    <td class="text-left">{{ $result->group_name }}</td>
                    <td class="text-center">
                      <a href="/sistem/permissions/edit/{{ str_pad($result->role_id,5,'0',STR_PAD_LEFT) }}" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="4">Data tidak ditemukan !!</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-4">
                <span class="help-block text-block my-0">Halaman {{ $rs_result->currentPage() }} dari {{ $rs_result->lastPage() }}</span>
                <span class="help-block text-block my-0">Menampilkan {{ $rs_result->firstItem() }} - {{ $rs_result->lastItem() }} dari {{ $rs_result->total() }} data</span>
              </div>
              <div class="col-md-8 text-right">
                {{ $rs_result->links() }}
              </div>
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
