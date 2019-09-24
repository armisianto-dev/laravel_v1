@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Portal</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li class="active">Portal</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-control">
              <a href="/sistem/portal/create" class="btn btn-info">
                <i class="fa fa-plus mr-5"></i> Tambah Data
              </a>
            </div>
            <h3 class="panel-title">List Portal</h3>
          </div>
          <div class="panel-body">
            @include('includes.flash-message')
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">ID Portal</th>
                    <th width="15%" class="text-left">Nama Portal</th>
                    <th width="15%" class="text-left">Site Title</th>
                    <th width="15%" class="text-left">Site Desc</th>
                    <th width="20%" class="text-left">Meta Desc</th>
                    <th width="20%" class="text-left">Meta Keyword</th>
                    <th width="10%" class="text-center">#</th>
                  </tr>
                </thead>
                <tbody>
                  @if($rs_portal->count())
                  @foreach($rs_portal as $i=>$portal)
                  <tr>
                    <td class="text-center">{{ $portal->portal_id }}</td>
                    <td class="text-left">{{ $portal->portal_nm }}</td>
                    <td class="text-left">{{ $portal->site_title }}</td>
                    <td class="text-left">{{ $portal->site_desc }}</td>
                    <td class="text-left">{{ $portal->meta_desc }}</td>
                    <td class="text-left">{{ $portal->meta_keyword }}</td>
                    <td class="text-center">
                      <a href="/sistem/portal/edit/{{ $portal->portal_id }}" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="/sistem/portal/delete/{{ $portal->portal_id }}" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="7">Data tidak ditemukan !!</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
