<?php
class NGSettingsTabs extends NGSetting {
	const IdTabs = 'Tabs';
	const ObjectTypeSettingsTabs = 'NGSettingsTabs';
	const DomainTabs = 'tabs';
	public $colorBorder = 'ebebeb';
    public $colorBorderActive = '';
    public $colorBorderHover = '';
	public $colorText = '5a5a5a';
    public $colorTextActive = '';
    public $colorTextHover = '';
	public $colorBackground = 'ffffff';
	public $colorBackgroundHover = 'fcfcfc';
	public $colorBackgroundActive = 'ebebeb';
	public $roundedCorners = 0;
	public $tabBorder = true;
	public $paddingvertical = 10;
	public $paddinghorizontal = 20;
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvalueborder', NGProperty::TypeString, self::DomainTabs, 'colorBorder', NGPropertyMapped::MultiplicityScalar, false, 'ebebeb', false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'colorvalueborderactive', NGProperty::TypeString, self::DomainTabs, 'colorBorderActive', NGPropertyMapped::MultiplicityScalar, false, '', false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'colorvalueborderhover', NGProperty::TypeString, self::DomainTabs, 'colorBorderHover', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvaluetext', NGProperty::TypeString, self::DomainTabs, 'colorText', NGPropertyMapped::MultiplicityScalar, false, '5a5a5a', false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'colorvaluetextactive', NGProperty::TypeString, self::DomainTabs, 'colorTextActive', NGPropertyMapped::MultiplicityScalar, false, '', false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'colorvaluetexthover', NGProperty::TypeString, self::DomainTabs, 'colorTextHover', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvaluebackground', NGProperty::TypeString, self::DomainTabs, 'colorBackground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvaluebackgroundhover', NGProperty::TypeString, self::DomainTabs, 'colorBackgroundHover', NGPropertyMapped::MultiplicityScalar, false, 'fcfcfc', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvaluebackgroundactive', NGProperty::TypeString, self::DomainTabs, 'colorBackgroundActive', NGPropertyMapped::MultiplicityScalar, false, 'ebebeb', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'roundedcorners', NGProperty::TypeInt, self::DomainTabs, 'roundedCorners', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'tabborder', NGProperty::TypeBool, self::DomainTabs, 'tabBorder', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'paddingvertical', NGProperty::TypeInt, self::DomainTabs, 'paddingvertical', NGPropertyMapped::MultiplicityScalar, false, 10, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'paddinghorizontal', NGProperty::TypeInt, self::DomainTabs, 'paddinghorizontal', NGPropertyMapped::MultiplicityScalar, false, 20, false );
		}
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdTabs );
	}
}