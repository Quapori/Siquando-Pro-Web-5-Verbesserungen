<?php

class NGDuplicateValueException extends NGException
{
	public $collisions;
	
	public function __construct($collisions)
	{
		$message='';
		
		foreach ($collisions as $collision) {
			$message.=sprintf('Value "%s" of property "%s" already defined by "%s". ', $collision[NGDBAdapterObject::CollisionValue], $collision[NGDBAdapterObject::CollisionName], $collision[NGDBAdapterObject::CollisionObjectUID]);
		}
		
		$message=trim($message);
				
		parent::__construct($message, 30002);
		$this->collisions=$collisions;
	}
	
	public function getAdditionalInfo()
	{
		return array(
			'collision' => $this->collisions
		);
	}
}