<?php

use LaravelBook\Ardent\Ardent;

class Post extends Ardent {

    public $autoHydrateEntityFromInput = true;

    /**
     * Model attributes allowed to be mass assigned.
     * @var array
     */
    protected $fillable = array('title', 'author', 'body');

	protected $guarded = array('id');

	public static $rules = array('title' => 'required');

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

    public function beforeSave() {
        // Save the current user as author.
        if($this->isDirty('author') && Auth::check()) {
            $this->author = Auth::user()->id;
        }

        return true;
    }

}
