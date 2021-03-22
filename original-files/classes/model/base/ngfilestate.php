<?php

/**
 * 
 * Represents info about a file
 *
 *
 */
class NGFileState {
    const FileStateMissing=1;
	const FileStatePartial=2;
	const FileStateComplete=3;
	
	public $state;
	public $size;
	public $path;
	
	public function __construct() {
		$this->state=self::FileStateMissing;
		$this->size=0;
		$this->path='';
	}
}