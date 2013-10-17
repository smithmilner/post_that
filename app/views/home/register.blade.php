@extends('layouts.master')

@section('content')

<div class="row">
    <div class="well">
        <legend>Please Register</legend>
        {{ Form::open(array('url' => 'register')) }}
        @if($errors->any())
        <div class="alert alert-error">
            <a href="#" data-dismiss="alert">&times;</a>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </div>
        @endif
        {{ Form::text('username', '', array('placeholder' => 'Username')) }}<br />
        {{ Form::text('email', '', array('placeholder' => 'Email')) }}<br />
        {{ Form::password('password', array('placeholder' => 'Password')) }}<br />

        {{ Form::submit('Register', array('class' => 'btn btn-success')) }}
        {{ HTML::link('/', 'Cancel', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>

@stop