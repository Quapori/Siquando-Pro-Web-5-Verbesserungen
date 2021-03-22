<?php

class NGNotLoggedInException extends NGException
{
	public function __construct()
	{
		parent::__construct('Not logged in.', 30003, true);
	}
}