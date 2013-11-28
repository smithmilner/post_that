<?php namespace Authz\Services\Validators;

interface ValidatorInterface {

	function passes();
	function getErrors();

}