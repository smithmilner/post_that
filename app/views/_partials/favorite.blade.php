<div class="favorite">
	{{ Form::open(array('route' => 'flags.store')) }}
		{{ Form::hidden('post_id', $post->id) }}
		{{ Form::submit('Favorite', array('class' => 'btn btn-info')) }}
	{{ Form::close() }}
</div>