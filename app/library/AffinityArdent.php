<?php

use LaravelBook\Ardent\Ardent;

class AffinityArdent extends Ardent {

	/**
	 * Add model validation errors to the alert service.
	 */
	public function displayErrors() {
	    // Add validation errors to the page.
	    foreach($this->validationErrors->all() as $error) {
	        Alert::error($error);
	    }
	    Alert::flash();
	}

}