@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Groups</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li class="active">Groups</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/groups/create" class="btn btn-info">
                <i class="fa fa-plus mr-5"></i> Tambah Data
              </a>
            </div>
            <h3 class="panel-title">List Groups</h3>
          </div>
          <div class="panel-body">
            @include('includes.flash-message')
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="5%" class="text-center">ID Groups</th>
                    <th width="20%" class="text-left">Nama Groups</th>
                    <th width="60%" class="text-left">Groups Desc</th>
                    <th width="10%" class="text-center">#</th>
                  </tr>
                </thead>
                <tbody>
                  @if($rs_group->count())
                  @foreach($rs_group as $i=>$group)
                  <tr>
                    <td class="text-center">{{ $rs_group->firstItem()+$i }}</td>
                    <td class="text-center">{{ $group->group_id }}</td>
                    <td class="text-left">{{ $group->group_name }}</td>
                    <td class="text-left">{{ $group->group_desc }}</td>
                    <td class="text-center">
                      <a href="/sistem/groups/edit/{{ $group->group_id }}" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="/sistem/groups/delete/{{ $group->group_id }}" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
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
                <span class="help-block text-block my-0">Halaman {{ $rs_group->currentPage() }} dari {{ $rs_group->lastPage() }}</span>
                <span class="help-block text-block my-0">Menampilkan {{ $rs_group->firstItem() }} - {{ $rs_group->lastItem() }} data dari {{ $rs_group->total() }} data</span>
              </div>
              <div class="col-md-8 text-right">
                {{ $rs_group->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
