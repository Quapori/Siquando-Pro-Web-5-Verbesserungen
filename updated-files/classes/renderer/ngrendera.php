<?php

/**
 * 
 * Renders the HTML-A Tag
  *
 */
class NGRenderA extends NGRenderTag
{
	const TAG_A='a';
	const ATTRIBUTE_HREF='href';
	
	/**
	 * 
	 * Link ref
	 */
	public $href;
	
	/***
	 * Render the tag
	 */
	public function render()
	{
		$this->attributes[self::ATTRIBUTE_HREF]=$this->href;
		
		return parent::render();
	}
	
	/**
	 * 
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->tag=self::TAG_A;
		$this->singleTag=false;
	}
}