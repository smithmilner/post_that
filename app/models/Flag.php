<?php

use LaravelBook\Ardent\Ardent;

class Flag extends Ardent {

	public $autoHydrateEntityFromInput = true;

	/**
     * Model attributes allowed to be mass assigned.
     * @var array
     */
    protected $fillable = array('post_id', 'user_id');

	protected $guarded = array('id');

	public static $rules = array(
        'post_id' => 'required'
        'user_id' => 'required',
    );


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function post()
    {
        return $this->belongsTo('Post');
    }

}
