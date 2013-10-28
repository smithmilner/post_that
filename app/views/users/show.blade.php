@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1>{{ ucwords(e($user->username)) }}</h1>
</div>

<div class="panel panel-info">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
		@if(count($flags))
			<strong>Favorite Posts:</strong>
			<ul>
				@foreach($flags as $flag)
					<li>{{ HTML::rawLinkRoute('posts.show', '<span class="glyphicon glyphicon-pencil"></span> ' . e($flag->post->title), array($flag->post->id)) }}</li>
				@endforeach
			</ul>
		@endif
    </div>
</div>

@stop