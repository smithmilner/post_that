<div class="favorite">
	@if ($flag = Auth::user()->flags()->where('post_id', '=', $post->id)->first())
	{{ Form::open(array('method' => 'delete', 'route' => array('flags.destroy', $flag->id))) }}
	{{ Form::submit('Unfavorite', array('class' => 'btn btn-danger')) }}
	{{ Form::close() }}
	@else
	{{ Form::open(array('route' => 'flags.store')) }}
		{{ Form::hidden('post_id', $post->id) }}
		{{ Form::submit('Favorite', array('class' => 'btn btn-info')) }}
	{{ Form::close() }}
	@endif
</div>