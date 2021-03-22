<?php

class NGSetting extends NGObjectNamed {
	const PrefixSetting = 'w001';
	
	public $id;
	
	public function setId($id) {
		$this->objectUID = NGUtil::idToUID ( self::PrefixSetting, $id );
		$this->name = $id;
		$this->id = $id;
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->parentUID = NGUtil::ObjectUIDRootSettings;
	}
	
	protected function totalExtraWidth($marginvalue, $paddingvalue, $bordervalue) {
		$margin = new NGMargin ( $marginvalue );
		$padding = new NGMargin ( $paddingvalue );
		$border = new NGMargin ( $bordervalue );
		
		return $margin->totalWidth () + $padding->totalWidth () + $border->totalWidth ();
	}

}