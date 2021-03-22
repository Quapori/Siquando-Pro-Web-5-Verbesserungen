<?php

class NGTopic extends NGFolder
{
    const ObjectTypeTopic = 'NGTopic';
    const DomainTopic = 'topic';

    /**
     *
     * Web version of picture
     * @var string
     */
    public $sortManualPages = '';
    public $sortManualTopics = '';
    public $picture = '';
    public $summary = '';
    public $indexUID = '';
    public $templateUID = NGUtil::ObjectUIDInherit;
    public $templateOverwrite = '';
    public $metaTags = array();
    public $htmlCode = array();
    public $forward = '';
    public $bouquetitemssource = 'Manual';
    public $bouqetsortmode = 'Natural';
    public $bouquetparentuid = '';
    public $bouquetitems = '';
    public $linkedmedia = array();
    public $hideeyecatcher = false;


    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmanualpages', NGProperty::TypeString, self::DomainTopic, 'sortManualPages', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sortmanualtopics', NGProperty::TypeString, self::DomainTopic, 'sortManualTopics', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('picture', NGProperty::TypeUID, NGObjectNamedSummaryPicture::DomainPicture, 'picture', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summary', NGProperty::TypeFulltext, NGObjectNamedSummary::DomainSummary, 'summary', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('metatags', NGProperty::TypeString, NGUtil::DomainSEO, 'metaTags', NGPropertyMapped::MultiplicityDictornary, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('htmlcode', NGProperty::TypeString, NGUtil::DomainSEO, 'htmlCode', NGPropertyMapped::MultiplicityDictornary);
        $this->propertiesMapped [] = new NGPropertyMapped ('indexuid', NGProperty::TypeUID, self::DomainTopic, 'indexUID');
        $this->propertiesMapped [] = new NGPropertyMapped ('templateuid', NGProperty::TypeUID, self::DomainTopic, 'templateUID');
        $this->propertiesMapped [] = new NGPropertyMapped ('templateoverwrite', NGProperty::TypeString, self::DomainTopic, 'templateOverwrite');
        $this->propertiesMapped [] = new NGPropertyMapped ('bouquetitemssource', NGProperty::TypeString, self::DomainTopic, 'bouquetitemssource');
        $this->propertiesMapped [] = new NGPropertyMapped ('bouqetsortmode', NGProperty::TypeString, self::DomainTopic, 'bouqetsortmode');
        $this->propertiesMapped [] = new NGPropertyMapped ('bouquetparentuid', NGProperty::TypeUID, self::DomainTopic, 'bouquetparentuid');
        $this->propertiesMapped [] = new NGPropertyMapped ('bouquetitems', NGProperty::TypeText, self::DomainTopic, 'bouquetitems');
        $this->propertiesMapped [] = new NGPropertyMapped ('linkedmedia', NGProperty::TypeString, self::DomainTopic, 'linkedmedia', NGPropertyMapped::MultiplicityDictornary);
        $this->propertiesMapped [] = new NGPropertyMapped ('hideeyecatcher', NGProperty::TypeBool, self::DomainTopic, 'hideeyecatcher', NGPropertyMapped::MultiplicityScalar, false, false, false);
    }

}