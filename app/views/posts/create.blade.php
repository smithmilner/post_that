@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
        <div class="panel panel-info">
            <div class="panel-heading">Add a new Post</div>
            <div class="panel-body">
                {{ Form::open(array('route' => array('posts.store'))) }}
                @if($errors->any())
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>
                @endif
                <div class="control-group">
                    {{ Form::label('title', 'Title: ') }}
                    {{ Form::text('title', '', array('placeholder' => 'add a title', 'class' => 'form-control')) }}
                    {{ Form::label('body', 'Body: ') }}
                    {{ Form::textarea('body', '', array('placeholder' => 'add some text to your note', 'class' => 'form-control')) }}
                </div></br>
                {{ Form::submit('Add', array('class' => 'btn btn-success')) }}
                {{ HTML::link('posts', 'Cancel', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop