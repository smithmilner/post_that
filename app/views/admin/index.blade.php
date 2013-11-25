@extends('layouts.master')

@section('content')

<div class="span8 well">
    <h4>Hello {{{ ucwords(Sentry::getUser()->username) }}}</h4>
</div>

@stop