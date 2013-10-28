@extends('layouts.master')

@section('content')

<div class="panel panel-info">
    <div class="panel-heading">
		<h3>{{ e($post->title) }}</h3>

		@include('_partials/favorite')

	</div>
    <div class="panel-body">
        <strong>{{ Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans() }} - {{ link_to_route('users.show', e(User::getUserName($post->user_id)), array($post->user_id)) }}</strong><br />
        {{ e($post->body) }}
    </div>
</div>



@stop