<?php namespace Authz\Models;

use \Eloquent as Eloquent;
use Authz\Models\User;

class Profile extends Eloquent {

	protected $guarded = array('id');


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('linkedinToken', 'linkedinSecret');

	public function user()
    {
        return $this->belongsTo('Authz\Models\User');
    }
}
