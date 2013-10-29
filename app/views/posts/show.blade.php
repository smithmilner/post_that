@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1>{{ ucwords(e($post->title)) }}</h1>
</div>

<div class="panel panel-info">
    <div class="panel-heading">
		<h3>Details</h3>

	</div>
    <div class="panel-body">
        <strong>{{ Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans() }} - {{ link_to_route('users.show', e(User::getUserName($post->user_id)), array($post->user_id)) }}</strong><br />
        {{ e($post->body) }}
    </div>
</div>

@stop

@section('sidebar')
	@parent

	@include('_partials/favorite')

	<br />
	@if(count($flags))
		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">Favorited By:</h3>
			</div>

			<div class="panel-body">
				<ul>
					@foreach($flags as $flag)
						<li>{{ HTML::rawLinkRoute('users.show', '<span class="glyphicon glyphicon-user"></span> ' . e($flag->user->username), array($flag->user->id)) }}</li>
					@endforeach
				</ul>
			</div>

		</div>

	@endif
@stop