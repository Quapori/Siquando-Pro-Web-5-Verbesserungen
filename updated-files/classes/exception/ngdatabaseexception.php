<?php

class NGDatabaseException extends NGException
{
	public $errorCode;
	public $errorMessage;
	public $sql;
	
	protected $actionToValue = array (
		NGObject::ActionView =>  NGRestObjectBase::ValueActionView,
		NGObject::ActionModify => NGRestObjectBase::ValueActionModify,
		NGObject::ActionAdd => NGRestObjectBase::ValueActionAdd,
		NGObject::ActionDelete => NGRestObjectBase::ValueActionDelete,
		NGObject::ActionAdmin => NGRestObjectBase::ValueActionAdmin
	);
	
	public function __construct($errorCode, $errorMessage, $sql = '')
	{
		if ($sql!=='') {
			parent::__construct(sprintf('Database access failed. Database error #%d: "%s". SQL: %s', $errorCode, $errorMessage, $sql), 30005);
		} 
		else 
		{
			parent::__construct(sprintf('Database access failed. Database error #%d: "%s".', $errorCode, $errorMessage), 30005);
		}
		
		$this->errorCode=$errorCode;
		$this->errorMessage=$errorMessage;
		$this->sql=$sql;
	}
	
	public function getAdditionalInfo()
	{
		return array(
			'databaseerrorcode' => $this->errorCode,
			'databaseerrormessage' => $this->errorMessage,
			'sql' => $this->sql
		);
	}
}