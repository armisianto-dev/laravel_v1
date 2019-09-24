@extends('layouts.default')
@section('content')
<h2>Welcome</h2>
<ul>
  <li>User ID : {{ $user['user_id'] }}</li>
  <li>User Alias : {{ $user['user_alias'] }}</li>
</ul>
@endsection
