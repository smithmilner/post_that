<?php

use LaravelBook\Ardent\Ardent;

class Post extends Ardent {

    public $autoHydrateEntityFromInput = true;

    /**
     * Model attributes allowed to be mass assigned.
     * @var array
     */
    protected $fillable = array('title', 'user_id', 'body');

	protected $guarded = array('id');

	public static $rules = array('title' => 'required');

    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Provides a base query builder to list posts by user id.
     * 
     * @param  int  $user_id
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public static function userPosts($user_id)
    {
        return static::where('user_id', '=', $user_id);
    }

}
