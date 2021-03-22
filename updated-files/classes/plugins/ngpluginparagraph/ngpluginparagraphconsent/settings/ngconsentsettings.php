<?php

class NGConsentSettings extends NGSetting
{
    const IdConsent = 'consent';
    const ObjectTypeNGConsentSettings = 'NGConsentSettings';
    const DomainParagraphConsent = 'paragraphconsent';

    public $coloron='8ba15d';

    public $coloroff='a65856';

    public $coloressential='9b9b9b';

    public $colorknob='ffffff';



    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('coloron', NGPropertyMapped::TypeString, self::DomainParagraphConsent, 'coloron', NGPropertyMapped::MultiplicityScalar, false, '8ba15d');
        $this->propertiesMapped [] = new NGPropertyMapped ('coloroff', NGPropertyMapped::TypeString, self::DomainParagraphConsent, 'coloroff', NGPropertyMapped::MultiplicityScalar, false, 'a65856');
        $this->propertiesMapped [] = new NGPropertyMapped ('coloressential', NGPropertyMapped::TypeString, self::DomainParagraphConsent, 'coloressential', NGPropertyMapped::MultiplicityScalar, false, '9b9b9b');
        $this->propertiesMapped [] = new NGPropertyMapped ('colorknob', NGPropertyMapped::TypeString, self::DomainParagraphConsent, 'colorknob', NGPropertyMapped::MultiplicityScalar, false, 'ffffff');
    }

    public function __construct()
    {
        parent::__construct();

        $this->setId(self::IdConsent);
    }
}