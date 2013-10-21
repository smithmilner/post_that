<?php

class Post extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    /**
     * Provides a base query builder to list posts by user id.
     * 
     * @param  int  $user_id
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public static function userPosts($user_id)
    {
        return static::where('author', '=', $user_id);
    }
}
