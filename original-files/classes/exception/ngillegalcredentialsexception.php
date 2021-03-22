<?php

class NGIllegalCredentialsException extends NGException
{
	public function __construct()
	{
		parent::__construct('Illegal Credentials provided for login.', 30001, true);
	}
}