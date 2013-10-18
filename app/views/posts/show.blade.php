@extends('layouts.master')

@section('content')

<div class="panel panel-info">
    <div class="panel-heading"><h3>{{ $post->title }}</h3></div>
    <div class="panel-body">
        <strong>{{ Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans() }} - {{ $author->username }}</strong><br />
        {{ $post->body }}
    </div>
</div>

@stop