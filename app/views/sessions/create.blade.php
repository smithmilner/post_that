@extends('layouts.master')

@section('content')

    <div class="well">
        <legend>Please Login</legend>
        {{ Form::open(array('url' => 'login')) }}
        {{ Form::text('username', '', array('placeholder' => 'Username')) }}<br />
        {{ Form::password('password', array('placeholder' => 'Password')) }}<br />

        {{ Form::submit('Login', array('class' => 'btn btn-success')) }}
        {{ HTML::link('register', 'Register', array('class' => 'btn btn-primary')) }}
        {{ $linkedInLink }}
        {{ Form::close() }}
    </div>


@stop