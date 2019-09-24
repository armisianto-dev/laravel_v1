@extends('layouts.default')@section('content')
<div id="page-content">
  <div class="row">
    <section class="content">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$video->video_title}}</h3>
          </div>
          <div class="panel-body">


            <div class="table-container">
              <div class="video" style="text-align:center">
                <iframe style="width:100%" height="315" src="{{$video->video_url}}" frameborder="0"
                  allowfullscreen></iframe>
                </div>
                <div class="video">
                  {{$video->description}}
                </div>


                <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-12">

                    <a href="{{ route('video.index') }}" class="btn btn-info btn-block">Back</a>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  @endsection
