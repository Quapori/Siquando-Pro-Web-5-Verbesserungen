<?php

class NGNotFoundException extends NGException
{
	public $objectUID;
	public $revisionUID;
	
	public function __construct($objectUID, $revisionUID='')
	{
		if ($revisionUID !== '') {
			parent::__construct ( sprintf ( 'Object %s (Revision %s) was not found.', $objectUID, $revisionUID ), 30006 );
		} else {
			parent::__construct ( sprintf ( 'Object %s was not found.', $objectUID ), 30006 );
		}
		$this->objectUID = $objectUID;
		$this->revisionUID = $revisionUID;
	}
	
	public function getAdditionalInfo()
	{
		return array(
			'objectuid' => $this->objectUID,
			'revisionuid' => $this->revisionUID
		);
	}
}