<?php

class NGAlreadyLoggedInException extends NGException
{
	public $login;
	
	public function __construct($login)
	{
		parent::__construct ( sprintf ( 'User %s is already logged in.', $login ), 30011 );
		$this->login = $login;	
	}
	
	public function getAdditionalInfo()
	{
		return array(
			'login' => $this->login
		);
	}
}