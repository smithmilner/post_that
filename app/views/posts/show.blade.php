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

@if(count($flags))
	<strong>Favorited By:</strong>
	<ul>
		@foreach($flags as $flag)
			<li>{{ HTML::rawLinkRoute('users.show', '<span class="glyphicon glyphicon-user"></span> ' . e($flag->user->username), array($flag->user->id)) }}</li>
		@endforeach
	</ul>
@endif



@stop