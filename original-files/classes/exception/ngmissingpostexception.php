<?php

class NGMissingPostException extends NGException
{
	public function __construct()
	{
		parent::__construct('Rest call is missing POST data. If your server is configured to forward http to https requests, use the https adress to access you site.', 30012, true);
	}
}