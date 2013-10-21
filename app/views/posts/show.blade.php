@extends('layouts.master')

@section('content')

<div class="panel panel-info">
    <div class="panel-heading"><h3>{{ e($post->title) }}</h3></div>
    <div class="panel-body">
        <strong>{{ Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans() }} - {{ e(User::getUserName($author->id)) }}</strong><br />
        {{ e($post->body) }}
    </div>
</div>

@stop