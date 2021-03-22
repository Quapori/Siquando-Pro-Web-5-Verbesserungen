<?php

class NGFoodMenuSettings extends NGSetting
{
    const IdFoodMenu = 'foodmenu';
    const ObjectTypeNGFoodMenuSettings = 'NGFoodMenuSettings';
    const DomainParagraphFoodMenu = 'paragraphfoodmenu';

    public $headingcolor = '';
    public $headingbold = false;
    public $headingitalic = false;
    public $headinguppercase = true;
    public $headingspaced = true;
    public $headingsize = 110;
    public $pricecolor = '';
    public $pricebold = true;
    public $priceitalic = false;
    public $priceuppercase = false;
    public $pricespaced = false;
    public $pricesize = 110;

    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('headingcolor', NGPropertyMapped::TypeString, self::DomainParagraphFoodMenu, 'headingcolor', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('headingbold', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'headingbold', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headingitalic', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'headingitalic', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headinguppercase', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'headinguppercase', NGPropertyMapped::MultiplicityScalar, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headingspaced', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'headingspaced', NGPropertyMapped::MultiplicityScalar, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headingsize', NGPropertyMapped::TypeInt, self::DomainParagraphFoodMenu, 'headingsize', NGPropertyMapped::MultiplicityScalar, true, 110);

        $this->propertiesMapped [] = new NGPropertyMapped ('pricecolor', NGPropertyMapped::TypeString, self::DomainParagraphFoodMenu, 'pricecolor', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('pricebold', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'pricebold', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('priceitalic', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'priceitalic', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('priceuppercase', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'priceuppercase', NGPropertyMapped::MultiplicityScalar, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pricespaced', NGPropertyMapped::TypeBool, self::DomainParagraphFoodMenu, 'pricespaced', NGPropertyMapped::MultiplicityScalar, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pricesize', NGPropertyMapped::TypeInt, self::DomainParagraphFoodMenu, 'pricesize', NGPropertyMapped::MultiplicityScalar, true, 110);
    }

    public function __construct()
    {
        parent::__construct();

        $this->setId(self::IdFoodMenu);
    }
}