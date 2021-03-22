<?php

class NGAccessDeniedException extends NGException
{
	public $action;
	public $objectUID;
		
	public function __construct($action, $objectUID)
	{
		parent::__construct(sprintf('Access %s is denied on object {%s}.', NGRestObjectBase::$actionToValue[$action], $objectUID ), 30004);
		$this->action=$action;
		$this->objectUID=$objectUID;
	}
	
	public function getAdditionalInfo()
	{
		return array(
			'action' => NGRestObjectBase::$actionToValue[$this->action],
			'objectuid' => $this->objectUID,
		);
	}
}