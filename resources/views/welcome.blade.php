@extends('layouts.app')
@section('title')  Dashboard @endsection
@section('content')
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
        <div id="app">
            <video-chat></video-chat>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
  </div>
@endsection
