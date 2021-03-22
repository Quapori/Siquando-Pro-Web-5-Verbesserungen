<?php

class NGRecursionException extends NGException
{
	public $parentUID;
	public $objectUID;
		
	public function __construct($parentUID, $objectUID)
	{
		parent::__construct(sprintf('Recursion: {%s} is ancestor of {%s}.', $objectUID, $parentUID ), 30008);
		$this->parentUID=$parentUID;
		$this->objectUID=$objectUID;
	}
	
	public function getAdditionalInfo()
	{
		return array(
			'parentuid' => $this->parentUID,
			'objectuid' => $this->objectUID,
		);
	}
}