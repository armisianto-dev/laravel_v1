@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Users</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li class="active">Users</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              @if($com_role['C'] == 1)
              <a href="/sistem/users/create" class="btn btn-info">
                <i class="fa fa-plus mr-5"></i> Tambah Data
              </a>
              @endif
            </div>
            <h3 class="panel-title">List Users</h3>
          </div>
          <div class="panel-body">
            <form class="form-inline" action="/sistem/users/search" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="user_name" class="sr-only">Username/E-Mail</label>
                <input type="text" name="user_name" placeholder="Username/E-Mail" id="user_name" class="form-control" value="{{ $search['user_name'] }}">
              </div>
              <div class="form-group">
                <label for="group_id" class="sr-only">Role</label>
                <select class="form-control" name="role_id" id="role_id" data-placeholder="Pilih Role">
                  <option value=""></option>
                  @if (count($rs_role) > 0)
                  @foreach ($rs_role as $role)
                  <option value="{{ str_pad($role->role_id,5,'0',STR_PAD_LEFT) }}"  @if (str_pad($role->role_id,5,'0',STR_PAD_LEFT) == str_pad($search['role_id'],5,'0',STR_PAD_LEFT)) selected="" @endif>{{ $role->role_nm }}</option>
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
                    <th width="5%" class="text-center">No</th>
                    <th width="15%" class="text-center">Username</th>
                    <th width="20%" class="text-center">Nama</th>
                    <th width="15%" class="text-center">E-Mail</th>
                    <th width="15%" class="text-center">Role</th>
                    <th width="10%" class="text-center">Status</th>
                    <th width="10%" class="text-center">Complete</th>
                    <th width="10%" class="text-center">#</th>
                  </tr>
                </thead>
                <tbody>
                  @if($rs_result->count())
                  @foreach($rs_result as $i=>$result)
                  <tr>
                    <td class="text-center">{{ $rs_result->firstItem()+$i }}</td>
                    <td class="text-left">{{ $result->user_name }}</td>
                    <td class="text-left">{{ $result->user_alias }}</td>
                    <td class="text-left">{{ $result->user_mail }}</td>
                    <td class="text-left">{{ $result->role_nm }}</td>
                    <td class="text-center">
                      {{ ($result->user_st == "1") ? 'Aktif' : 'Tidak Aktif'}}
                    </td>
                    <td class="text-center">
                      {{ ($result->user_completed == "1") ? 'Ya' : 'Tidak'}}
                    </td>
                    <td class="text-center">
                      @if($com_role['U'] == 1)
                      <a href="/sistem/users/edit/{{ $result->user_id }}" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i>
                      </a>
                      @endif
                      @if($com_role['D'] == 1)
                      <a href="/sistem/users/delete/{{ $result->user_id }}" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                      </a>
                      @endif
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
