@extends('layouts.master')

@section('content')

@if($posts->count())
<div class="page-header">
    <h1>
        {{ $posts->count() }}
        @if($posts->count() > 1)
        Posts
        @else
        Post
        @endif
        <small>Review everyones notes</small>
    </h1>
</div>
@endif

<ul class="nav nav-pills">
    <li>{{ HTML::link('posts/create', 'Add a new Post') }}</li>
</ul>

@if($posts->count())
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $p)
            <tr>
                <th>{{ HTML::rawLinkRoute('posts.show', '<span class="glyphicon glyphicon-pencil"></span> ' . $p->title, array($p->id)) }}</th>
                <th>
                    <span class="label label-info">
                        {{ Carbon::createFromTimestamp(strtotime($p->created_at))->diffForHumans() }}
                    </span>
                </th>
                <th>
                    <span class="label label-info">
                        {{ Carbon::createFromTimestamp(strtotime($p->updated_at))->diffForHumans() }}
                    </span>
                </th>
                <th>
                    {{ link_to_route('posts.edit', 'Edit', array($p->id), array('class' => 'btn btn-warning')) }}
                </th>
                <th>
                    {{ Form::open(array('method' => 'delete', 'route' => array('posts.destroy', $p->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-info">
        <strong>Hey There</strong> You have no posts.
    </div>
@endif

@stop