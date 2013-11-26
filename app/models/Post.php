<?php

use LaravelBook\Ardent\Ardent;

class Post extends Eloquent {

    /**
     * Model attributes allowed to be mass assigned.
     * @var array
     */
    protected $fillable = array('title', 'user_id', 'body', 'status');

	protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function flags()
    {
        return $this->hasMany('Flag');
    }

    /**
     * Factory
     */
    public static $factory = array(
        'title' => 'string',
        'user_id' => 'factory|User',
        'body' => 'body'
    );

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
