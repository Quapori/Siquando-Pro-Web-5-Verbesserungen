<?php

class NGInTrashException extends NGException
{
	public $objectUID;
	
	public function __construct($objectUID)
	{
		parent::__construct ( sprintf ( 'Object %s is in trash.', $objectUID ), 30007 );
		$this->objectUID = $objectUID;
	}
	
	public function getAdditionalInfo()
	{
		return array(
			'objectuid' => $this->objectUID
		);
	}
}