<?php
class NGRenderStyle
{
	public $selectors = array();
	
	private $output;
	
	public function render()
	{
		$this->output='';
		
		foreach ($this->selectors as $key => $value) {
			if ($value!==null) $this->output.=$key.':'.$value.';';
		}
		
		return $this->output;
	}
}