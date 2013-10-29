@extends('layouts.master')

@section('content')

<div class="panel panel-info">
    <div class="panel-heading"><strong>Edit:</strong> {{{ $post->title }}}</div>
    <div class="panel-body">
        {{ Form::open(array('route' => array('posts.update', $post->id), 'method' => 'put')) }}
        <div class="control-group">
            {{ Form::label('title', 'Title: ') }}
            {{ Form::text('title', e($post->title), array('placeholder' => 'add a title', 'class' => 'form-control')) }}
            {{ Form::label('body', 'Body: ') }}
            {{ Form::textarea('body', e($post->body), array('placeholder' => 'add some text to your note', 'class' => 'form-control')) }}
        </div></br>
        {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
        {{ HTML::link('posts', 'Cancel', array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}
    </div>
</div>

@stop