@extends('layouts.default')
@section('content')
<div id="page-title">
  <h1 class="page-header text-overflow">Navigation</h1>
</div>
<ol class="breadcrumb">
  <li><a href="#">Pengaturan Sistem</a></li>
  <li class="active">Navigation</li>
</ol>
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">List Navigation</h3>
          </div>
          <div class="panel-body">
            @include('includes.flash-message')
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">ID Portal</th>
                    <th width="30%" class="text-center">Nama Portal</th>
                    <th width="40%" class="text-center">Site Title</th>
                    <th width="15%" class="text-center">Jumlah Menu</th>
                    <th width="10%" class="text-center">#</th>
                  </tr>
                </thead>
                <tbody>
                  @if($rs_result->count())
                  @foreach($rs_result as $i=>$result)
                  <tr>
                    <td class="text-center">{{ $result->portal_id }}</td>
                    <td class="text-left">{{ $result->portal_nm }}</td>
                    <td class="text-left">{{ $result->site_title }}</td>
                    <td class="text-center">{{ $result->jumlah_menu }}</td>
                    <td class="text-center">
                      <a href="/sistem/menu/navigation/{{ $result->portal_id }}" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="5">Data tidak ditemukan !!</td>
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
