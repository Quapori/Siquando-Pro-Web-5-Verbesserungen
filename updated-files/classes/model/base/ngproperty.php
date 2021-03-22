<?php

/**
 * Represents an object proeprty
 */
class NGProperty {
    const TypeString=1;
    const TypeInt=2;
    const TypeFloat=3;
    const TypeBool=4;
    const TypeDateTime=5;
    const TypeText=6;
    const TypeFulltext=7;
    const TypeUID=8;
    const TypeFile=9;    
        
    
    public $name;
    public $type;
    public $value;
    public $domain;
    public $lang;
    public $index;
    public $unique;
    public $fileState;
    public $update;
    public $readOnly;
    
    /**
     * 
     * Construtor
     * @param string $name Name of property
     * @param int $type Type
     * @param mixed $value Value of property
     * @param string $domain Domain of property
     * @param string $lang Language of property
     */
    public function __construct($name, $type, $value, $lang=NGUtil::LanguageNeutral, $domain=NGUtil::DomainCore, $index='', $unique=false) {
        $this->name=$name;
        $this->type=$type;
        $this->value=$value;
        $this->domain=$domain;
        $this->lang=$lang;
        $this->index=$index;
        $this->unique=$unique;
        $this->fileState=new NGFileState();
        $this->update=false;
        $this->readOnly=false;
    }
    
    /**
     * 
     * Compares to another proeperty, as PHP compare is foobar
     * @param NGProperty $compareProperty
     */
    public function isEqualTo(NGProperty $compareProperty) {
    	switch ($compareProperty->type) {
    		case NGProperty::TypeInt:
   			case NGProperty::TypeFloat:   
			case NGProperty::TypeBool:
				return ($this->value==$compareProperty->value)?true:false;
			default:
				return (strcmp($this->value, $compareProperty->value)==0)?true:false;
    	}
    }
}