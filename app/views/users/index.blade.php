@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1>Users</h1>
</div>

@if($users->count())
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Username</th>
                <th>Posts</th>
                <th>Registered</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
              <tr>
                  <td>{{ link_to_route('users.show', ucwords(e($user->username)), array($user->id)) }}</td>
                  <td>{{ link_to_route('posts.user', count($user->posts) . ' posts', array($user->id)) }}</td>
                  <td>{{ Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans() }}</td>
              </tr>
            @endforeach
        </tbody>
    </table>

@endif

@stop