<?php

class NGLanguageResource
{
	public $caption;
	public $default;
	public $value;
	public $description;
	public $js=false;
	public $stdpages = array();
	
	public function isDirty()
	{
		return $this->value!=$this->default;
	}
}