@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1>{{ ucwords(e($user->username)) }}</h1>
</div>

<div class="panel panel-info">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <strong></strong><br />
    </div>
</div>

@stop