<?php
class NGObjectChange extends NGObject {
	const ChangeTypeInsert=1;
	const ChangeTypeUpdate=2;
	const ChangeTypeDelete=3;
	const ChangeTypeUnchanged=4;
	
	/**
	 * 
	 * Type of change
	 * @var int
	 */
	public $changeType;
	
	/**
	 * 
	 * UID of Change
	 * @var string
	 */
	public $changeUID;
	
	/**
	 * 
	 * UID of Owner of Change
	 * @var string
	 */
	public $changeOwner;
	
		
	/**
	 * 
	 * User defined Annotation associated with object change
	 * @var string Annotation
	 */
	public $annotation;
	
	/**
	 * 
	 * revisionUID if change refers to a revision
	 * @var string
	 */
	public $revisionUID='';

	/**
	 * 
	 * Constructore
	 * @param string $changeUID
	 * @param int $changeType
	 * @param string $objectUID
	 * @param string $class
	 * @param string $owner
	 * @param string $changeDate
	 * @param string $annotation
	 */
	public function __construct($changeUID, $changeType, $objectUID, $class, $owner, $changeDate, $annotation, $revisionUID, $ownerGroup, $changeOwner, $parentUID) {
		$this->changeUID=$changeUID;
		$this->changeType=$changeType;
		$this->objectUID=$objectUID;
		$this->class=$class;
		$this->owner=$owner;
		$this->changeDate=$changeDate;
		$this->annotation=$annotation;
		$this->revisionUID=$revisionUID;
		$this->ownerGroup=$ownerGroup;
		$this->changeOwner=$changeOwner;
		$this->parentUID=$parentUID;
	}
}