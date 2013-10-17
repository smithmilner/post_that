@extends('layouts.master')

@section('content')

<div class="col-md-12" style="margin-top:50px">
    {{ HTML::link('posts/create', 'Add a new Post', array('class' => 'btn btn-primary')) }}
</div>

@if($posts->count())
    <h4>These are your posts!</h4>
    <div class="col-md-8">
        <table class="table table-bordered table-striped">
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
                    <th>{{ $p->title }}</th>
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
    </div>
@else
    <div class="alert alert-info col-md-2" style="margin-top:15px">
        <strong>Hey There</strong> You have no posts.
    </div>
@endif

@stop