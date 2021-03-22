<?php

/** 
 *
 * 
 * 
 */
class NGGrantChange {
	const ChangeTypeInsert=1;
	const ChangeTypeUpdate=2;
	const ChangeTypeDelete=3;
	
	/**
	 * 
	 * Type of change
	 * @var int
	 */
	public $changeType;
	
	/**
	 * 
	 * Scope of grant
	 * @var int
	 */
	public $access;
	
	/**
	 * 
	 * Konstruktor
	 * @param int $changeType
	 * @param int $access
	 */
	public function __construct($changeType, $access) {
	 	$this->changeType=$changeType;
	 	$this->access=$access;
	}
}