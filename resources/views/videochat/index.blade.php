@extends('layouts.app')

@section ('title')
    Video
@endsection

@section ('header')
    Video Chat
@endsection

@section('content')
<video-chat :user="{{ $user }}" :others="{{ $others }}" 
pusher-key="{{ config('broadcasting.connections.pusher.key') }}" 
pusher-cluster="{{ config('broadcasting.connections.pusher.options.cluster') }}"></video-chat>
@endsection
