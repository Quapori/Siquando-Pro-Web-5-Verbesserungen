<?php

class NGRenderTag
{
	const ATTRIBUTE_ID='id';
	const ATTRIBUTE_CLASS='class';
	const ATTRIBUTE_STYLE='style';
	
	public $tag='';
	
	public $id=null;
	
	public $class=null;
	
	public $content='';
	
	public $singleTag=true;
	
	public $attributes = array();
	
	/**
	 * 
	 * CSS Style
	 * @var NGRenderStyle
	 */
	public $style;
	
	private $output;
	
	public function render()
	{
		$this->output='<'.$this->tag;
		
		$this->attributes[self::ATTRIBUTE_ID]=$this->id;
		$this->attributes[self::ATTRIBUTE_CLASS]=$this->class;
		
		$style=$this->style->render();
		if ($style!='') $this->attributes[self::ATTRIBUTE_STYLE]=$style;

		$this->renderAttributes();
		
		if ($this->singleTag) 
		{
			$this->output.='/>';
		} else 
		{
			$this->output.='>'.$this->content.'</'.$this->tag.'>';
		}
		
		return $this->output;
	}
	
	public function __construct($tag='', $singleTag=false)
	{
		$this->style=new NGRenderStyle();
		$this->tag=$tag;
		$this->singleTag=$singleTag;
	}
	
	protected function renderAttributes()
	{
		foreach ($this->attributes as $id => $value) {
			if ($value!==null) $this->output.=' '.$id.'="'.htmlspecialchars($value).'"';
		}
	}
	
	/**
	 * 
	 * Create a simple render
	 * @param string $tag
	 * @param boolean $singleTag
	 */
	public static function create($tag, $singleTag=false)
	{
		$renderTag= new NGRenderTag();
		$renderTag->tag=$tag;
		$renderTag->singleTag=$singleTag;
		
		return $renderTag;
	}
	
}