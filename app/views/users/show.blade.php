@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1>{{ ucwords(e($user->username)) }}</h1>
</div>

<div class="panel panel-info">
    <div class="panel-heading"><h3>A little about me...</h3></div>
    <div class="panel-body">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, minus maxime cupiditate magni ratione iusto dolorum accusantium accusamus. Impedit quae rerum excepturi in reiciendis adipisci officiis ex eius nihil debitis.
    </div>
</div>

@stop

@section('sidebar')

	@if(count($flags))

		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">Favorite Posts:</h3>
			</div>

			<div class="panel-body">
				<ul>
					@foreach($flags as $flag)
						<li>{{ HTML::rawLinkRoute('posts.show', '<span class="glyphicon glyphicon-pencil"></span> ' . e($flag->post->title), array($flag->post->id)) }}</li>
					@endforeach
				</ul>
			</div>

		</div>

	@endif
@stop