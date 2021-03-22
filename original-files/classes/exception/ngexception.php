<?php

class NGException extends Exception
{
	protected $hideDebugInfo; 
	
	public function __construct($message = null, $code = 30000, $hideDebugInfo=false)
	{
		parent::__construct($message, $code);
		$this->hideDebugInfo=$hideDebugInfo;
	}
	
	final public function getHideDebugInfo()
	{
		return $this->hideDebugInfo;
	}
	
	public function getAdditionalInfo()
	{
		return null;
	}
}