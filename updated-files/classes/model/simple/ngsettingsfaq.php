<?php

class NGSettingsFAQ extends NGSetting
{
    const IdFAQ = 'FAQ';
    const ObjectTypeSettingsFAQ = 'NGSettingsFAQ';
    const DomainFAQ = 'faq';
    public $colorBorder = 'd7d7d7';
    public $colorBorderActive = '464646';
    public $colorBorderHover = '';
    public $colorText = '9b9b9b';
    public $colorTextActive = '444444';
    public $colorTextHover = '';
    public $paddingvertical = 10;
    public $paddinghorizontal = 20;


    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('colorvalueborder', NGProperty::TypeString, self::DomainFAQ, 'colorBorder', NGPropertyMapped::MultiplicityScalar, false, 'd7d7d7', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorvalueborderactive', NGProperty::TypeString, self::DomainFAQ, 'colorBorderActive', NGPropertyMapped::MultiplicityScalar, false, '464646', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorvalueborderhover', NGProperty::TypeString, self::DomainFAQ, 'colorBorderHover', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorvaluetext', NGProperty::TypeString, self::DomainFAQ, 'colorText', NGPropertyMapped::MultiplicityScalar, false, '9b9b9b', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorvaluetextactive', NGProperty::TypeString, self::DomainFAQ, 'colorTextActive', NGPropertyMapped::MultiplicityScalar, false, '444444', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorvaluetexthover', NGProperty::TypeString, self::DomainFAQ, 'colorTextHover', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('paddingvertical', NGProperty::TypeInt, self::DomainFAQ, 'paddingvertical', NGPropertyMapped::MultiplicityScalar, false, 10, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('paddinghorizontal', NGProperty::TypeInt, self::DomainFAQ, 'paddinghorizontal', NGPropertyMapped::MultiplicityScalar, false, 20, false);
    }

    public function __construct()
    {
        parent::__construct();

        $this->setId(self::IdFAQ);
    }
}