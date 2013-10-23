@extends('layouts.master')

@section('content')

@if($posts->count())
<div class="page-header">
    <h1>
        Review {{ User::getUserName($author->id) }}'s Posts
        <small>{{ $posts->count() }} @if($posts->count() > 1) Posts @else Post @endif </small>
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
                <th>Author</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $p)
            <tr>
                <td>{{ HTML::rawLinkRoute('posts.show', '<span class="glyphicon glyphicon-pencil"></span> ' . e($p->title), array($p->id)) }}
                </td>
                <td>
                    {{ User::getUserName($p->user_id) }}
                </td>
                <td>
                    <span class="label label-info">
                        {{ Carbon::createFromTimestamp(strtotime($p->created_at))->diffForHumans() }}
                    </span>
                </td>
                <td>
                    <span class="label label-info">
                        {{ Carbon::createFromTimestamp(strtotime($p->updated_at))->diffForHumans() }}
                    </span>
                </td>
                <td>
                    {{ link_to_route('posts.edit', 'Edit', array($p->id), array('class' => 'btn btn-warning')) }}
                </td>
                <td>
                    {{ Form::open(array('method' => 'delete', 'route' => array('posts.destroy', $p->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </td>
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