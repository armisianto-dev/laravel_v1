@extends('layouts.default')
@section('content')
<div id="page-content">
  <div class="row">
    <section class="content">

      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="pull-left">
              <h3>List Videos</h3>
            </div>
            <div class="pull-right">
              <div class="btn-group">

                <a href="{{ route('video.create') }}" class="btn btn-info">Add New</a>

              </div>
            </div>
            <div class="table-container">
              <table id="mytable" class="table table-bordred table-striped">
                <thead>
                  <th><input type="checkbox" id="checkall" /></th>
                  <th>Video Title</th>
                  <th>Video URL</th>
                  <th>Video Description</th>
                  <th>Status</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </thead>
                <tbody>
                  @if($videos->count())
                  @foreach($videos as $video)
                  <tr>
                    <td><input type="checkbox" class="checkthis" /></td>
                    <td>{{$video->video_title}}</td>
                    <td>{{$video->video_url}}</td>
                    <td>{{$video->description}}</td>
                    <td>
                      <span class="label label-{{ ($video->status) ? 'success' : 'danger' }}">{{ ($video->status) ? ' Active ' : 'Inactive' }}</span>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="{{action('VideoController@show', $video->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="{{action('VideoController@edit', $video->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <td>
                      <form action="{{action('VideoController@destroy', $video->id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">

                        <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td colspan="7">No Records found !!</td>
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
