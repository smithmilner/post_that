@extends('layouts.master')

@section('content')

<div class="row">
    <div class="well">
        <legend>Please Register</legend>
        {{ Form::open(array('url' => 'register')) }}
        {{ Form::text('username', '', array('placeholder' => 'Username')) }}<br />
        {{ Form::text('email', '', array('placeholder' => 'Email')) }}<br />
        {{ Form::password('password', array('placeholder' => 'Password')) }}<br />

        {{ Form::submit('Register', array('class' => 'btn btn-success')) }}
        {{ HTML::link('/', 'Cancel', array('class' => 'btn btn-primary')) }}
        {{ $linkedinLink; }}
        {{ Form::close() }}
        <br>
        {{ link_to_route('sessions.create', 'Already have an account? login!') }}
    </div>
</div>

@stop