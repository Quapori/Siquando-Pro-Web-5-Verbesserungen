<?php

class NGPluginLayoutFlexRSettings extends NGSetting
{
    const IdLayoutFlexR = 'LayoutFlexR';
    const ObjectTypePluginLayoutFlexRSettings = 'NGPluginLayoutFlexRSettings';
    const DomainLayoutFlexR = 'LayoutFlexR';

    public $background = 'solid ffffff';
    public $filltop = '';
    public $fillbottom = '';
    public $width = 1200;
    public $mobilewidth = 1024;
    public $captionposition = 'content';
    public $breadcrumbs = true;

    public $commontopbackground = '';
    public $commontopfill = 'solid 828282';
    public $commontoppadding = '20';
    public $commontopmargin = '0';
    public $commontopvisible = false;
    public $commontoppanorama = false;
    public $commontoppages = 'Open Sans,15,false,false,false,ebebeb';
    public $commontoppageshover = 'false,false,false,ffffff';
    public $commontopalignment = 'right';
    public $commontophidemobile = true;

    public $contactbackground = '';
    public $contactfill = '';
    public $contactpadding = '20';
    public $contactmargin = '0';
    public $contactvisible = false;
    public $contactpanorama = false;
    public $contacttext = 'open sans,15,false,false,false,828282';
    public $contacttexthover = 'false,false,false,666666';
    public $contactalignment = 'right';
    public $contacthidemobile = true;
    public $contactphone = '';
    public $contactphoneiso = '';
    public $contactaddress = '';
    public $contactmail = '';
    public $contactfacebook = '';
    public $contacttwitter = '';
    public $contactgoogleplus = '';
    public $contactlinkedin = '';
    public $contactinstagram = '';
    public $contactxing = '';
    public $contactyoutube = '';
    public $contactpinterest = '';
    public $contactnavigation = '';

    public $logobackground = '';
    public $logofill = 'solid 828282';
    public $logopadding = '20';
    public $logomargin = '0';
    public $logovisible = false;
    public $logopanorama = false;
    public $logologo = '';
    public $logowidth = 320;
    public $logoalignment = 'left';

    public $navbackground = '';
    public $navfill = 'solid 828282';
    public $navpadding = '0';
    public $navmargin = '0';
    public $navvisible = true;
    public $navpanorama = false;
    public $navpaddingpri = '15';
    public $navbackgroundpri = '';
    public $navfontpri = 'Open Sans,15,false,false,false,ebebeb';
    public $navbackgroundpriopen = 'solid fcfcfc';
    public $navcolorpriopen = '828282';
    public $navpaddingsec = '15';
    public $navbackgroundsec = 'solid fcfcfc';
    public $navfontsec = 'Open Sans,15,false,false,false,828282';
    public $navdivider = true;
    public $navhover = true;
    public $navanimate = true;
    public $navlogo = '';
    public $navstylemore = 'moredefault';
    public $navstylehome = 'homedefault';
    public $navstylemenu = 'menudefault';
    public $navpaddingsearch = '8';
    public $navbackgroundsearch = 'solid ffffff';
    public $navstylesearch = 'searchdefault';
    public $navfontsearch = 'Open Sans,15,false,false,false,828282';
    public $navshowsearch = true;
    public $navincludehome = true;
    public $navmarkactive = true;
    public $navshadow = true;
    public $navfixed = false;

    public $navpaddingter = '8 15 8 15';
    public $navfontter = 'Open Sans,13,false,false,false,828282';
    public $navhovercolor = '000000';
    public $navsuper = false;
    public $navcolumns = 4;
    public $navpicturespri = 'Hidden';
    public $navpicturessec = 'Hidden';
    public $navpicturester = 'Hidden';
    public $navfillsec = '';
    public $navstylecart = 'none';
    public $navstyleaccount = 'none';

    public $navcolorbubble = 'ffffff';
    public $navbackgroundbubble = 'solid f79646';


    public $eyecatcherbackground = '';
    public $eyecatcherfill = '';
    public $eyecatcherpadding = '0';
    public $eyecatchermargin = '0';
    public $eyecatchervisible = true;
    public $eyecatcherpanorama = true;
    public $eyecatcherpicture = '';
    public $eyecatcherautoprogress = 5;
    public $eyecatcherheight = 50;
    public $eyecatcherinheritance = true;
    public $eyecatchermutevideo = true;
    public $eyecatcherbulletstyle = 'bulletdefault';
    public $eyecatcherbulletcolora = 'ffffff';
    public $eyecatcherbulletcolorb = '000000';

    public $headerbackground = '';
    public $headerfill = '';
    public $headerpadding = '20';
    public $headermargin = '0';
    public $headervisible = true;
    public $headerpanorama = true;

    public $mainbackground = '';
    public $mainfill = '';
    public $mainpanorama = true;
    public $mainsidebarmode = 'medium';
    public $mainmargin = '0';

    public $leftbackground = '';
    public $leftpadding = '20';
    public $leftvisible = true;

    public $contentbackground = '';
    public $contentpadding = '20';

    public $rightbackground = '';
    public $rightpadding = '20';
    public $rightvisible = true;

    public $footerbackground = '';
    public $footerfill = '';
    public $footerpadding = '20';
    public $footermargin = '0';
    public $footervisible = true;
    public $footerpanorama = true;

    public $commonbackground = '';
    public $commonfill = 'solid 828282';
    public $commonpadding = '20';
    public $commonmargin = '0';
    public $commonvisible = true;
    public $commonpanorama = false;
    public $commonshowpages = true;
    public $commonshowfolders = true;
    public $commonshowcontact = false;
    public $commonfolders = 'Open Sans,15,false,false,true,ebebeb';
    public $commonpages = 'Open Sans,15,false,false,false,ebebeb';
    public $commonpageshover = 'false,false,false,ffffff';
    public $commontext = 'Open Sans,15,false,false,false,ebebeb';
    public $commonpagesalignment='left';
    public $commoncontactalignment='right';

    public $commonlink = 'true,false,false,ebebeb';
    public $commonhover = 'true,false,false,ffffff';
    public $commonhtml = '';

    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('background', NGProperty::TypeString, self::DomainLayoutFlexR, 'background', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('filltop', NGProperty::TypeString, self::DomainLayoutFlexR, 'filltop', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('fillbottom', NGProperty::TypeString, self::DomainLayoutFlexR, 'fillbottom', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('mobilewidth', NGProperty::TypeInt, self::DomainLayoutFlexR, 'mobilewidth', NGPropertyMapped::MultiplicityScalar, false, 1024, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('width', NGProperty::TypeInt, self::DomainLayoutFlexR, 'width', NGPropertyMapped::MultiplicityScalar, false, 1200, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionposition', NGProperty::TypeString, self::DomainLayoutFlexR, 'captionposition', NGPropertyMapped::MultiplicityScalar, false, 'content', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('breadcrumbs', NGProperty::TypeBool, self::DomainLayoutFlexR, 'breadcrumbs', NGPropertyMapped::MultiplicityScalar, false, true, false);

        $this->propertiesMapped [] = new NGPropertyMapped ('commontopbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontopbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontopfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontopfill', NGPropertyMapped::MultiplicityScalar, false, 'solid 828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontoppadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontoppadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontopmargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontopmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontopvisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commontopvisible', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontoppanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commontoppanorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontophidemobile', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commontophidemobile', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontoppages', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontoppages', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,false,ebebeb', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontoppageshover', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontoppageshover', NGPropertyMapped::MultiplicityScalar, false, 'false,false,false,ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontopalignment', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontopalignment', NGPropertyMapped::MultiplicityScalar, false, 'right', false);

        $this->propertiesMapped [] = new NGPropertyMapped ('contactbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'contactbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'contactfill', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'contactpadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactmargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'contactmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactvisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'contactvisible', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactpanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'contactpanorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contacthidemobile', NGProperty::TypeBool, self::DomainLayoutFlexR, 'contacthidemobile', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactalignment', NGProperty::TypeString, self::DomainLayoutFlexR, 'contactalignment', NGPropertyMapped::MultiplicityScalar, false, 'right', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contacttext', NGProperty::TypeString, self::DomainLayoutFlexR, 'contacttext', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,false,828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contacttexthover', NGProperty::TypeString, self::DomainLayoutFlexR, 'contacttexthover', NGPropertyMapped::MultiplicityScalar, false, 'false,false,false,666666', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactphone', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactphone', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactphoneiso', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactphoneiso', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactaddress', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactaddress', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactmail', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactmail', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactfacebook', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactfacebook', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contacttwitter', NGProperty::TypeText, self::DomainLayoutFlexR, 'contacttwitter', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactgoogleplus', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactgoogleplus', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactlinkedin', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactlinkedin', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactinstagram', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactinstagram', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactxing', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactxing', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactyoutube', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactyoutube', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactpinterest', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactpinterest', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contactnavigation', NGProperty::TypeText, self::DomainLayoutFlexR, 'contactnavigation', NGPropertyMapped::MultiplicityScalar, true, '', false);

        $this->propertiesMapped [] = new NGPropertyMapped ('logobackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'logobackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logofill', NGProperty::TypeString, self::DomainLayoutFlexR, 'logofill', NGPropertyMapped::MultiplicityScalar, false, 'solid 828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logopadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'logopadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logomargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'logomargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logovisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'logovisible', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logopanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'logopanorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logologo', NGProperty::TypeString, self::DomainLayoutFlexR, 'logologo', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logowidth', NGProperty::TypeInt, self::DomainLayoutFlexR, 'logowidth', NGPropertyMapped::MultiplicityScalar, false, 320, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('logoalignment', NGProperty::TypeString, self::DomainLayoutFlexR, 'logoalignment', NGPropertyMapped::MultiplicityScalar, false, 'left', false);

        $this->propertiesMapped [] = new NGPropertyMapped ('navbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'navbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'navfill', NGPropertyMapped::MultiplicityScalar, false, 'solid 828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navmargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'navmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navvisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navvisible', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navpanorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpaddingpri', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpaddingpri', NGPropertyMapped::MultiplicityScalar, false, '15', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navbackgroundpri', NGProperty::TypeString, self::DomainLayoutFlexR, 'navbackgroundpri', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navfontpri', NGProperty::TypeString, self::DomainLayoutFlexR, 'navfontpri', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,false,ebebeb', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navbackgroundpriopen', NGProperty::TypeString, self::DomainLayoutFlexR, 'navbackgroundpriopen', NGPropertyMapped::MultiplicityScalar, false, 'solid fcfcfc', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navcolorpriopen', NGProperty::TypeString, self::DomainLayoutFlexR, 'navcolorpriopen', NGPropertyMapped::MultiplicityScalar, false, '828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpaddingsec', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpaddingsec', NGPropertyMapped::MultiplicityScalar, false, '15', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navbackgroundsec', NGProperty::TypeString, self::DomainLayoutFlexR, 'navbackgroundsec', NGPropertyMapped::MultiplicityScalar, false, 'solid fcfcfc', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navfontsec', NGProperty::TypeString, self::DomainLayoutFlexR, 'navfontsec', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,false,828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navdivider', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navdivider', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navhover', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navhover', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navanimate', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navanimate', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navlogo', NGProperty::TypeString, self::DomainLayoutFlexR, 'navlogo', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navstylemore', NGProperty::TypeString, self::DomainLayoutFlexR, 'navstylemore', NGPropertyMapped::MultiplicityScalar, false, 'moredefault', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navstylehome', NGProperty::TypeString, self::DomainLayoutFlexR, 'navstylehome', NGPropertyMapped::MultiplicityScalar, false, 'homedefault', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navstylemenu', NGProperty::TypeString, self::DomainLayoutFlexR, 'navstylemenu', NGPropertyMapped::MultiplicityScalar, false, 'menudefault', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpaddingsearch', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpaddingsearch', NGPropertyMapped::MultiplicityScalar, false, '8', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navbackgroundsearch', NGProperty::TypeString, self::DomainLayoutFlexR, 'navbackgroundsearch', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navstylesearch', NGProperty::TypeString, self::DomainLayoutFlexR, 'navstylesearch', NGPropertyMapped::MultiplicityScalar, false, 'searchdefault', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navfontsearch', NGProperty::TypeString, self::DomainLayoutFlexR, 'navfontsearch', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,false,828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navshowsearch', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navshowsearch', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navincludehome', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navincludehome', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navmarkactive', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navmarkactive', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navshadow', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navshadow', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navfixed', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navfixed', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navbackgroundbubble', NGProperty::TypeString, self::DomainLayoutFlexR, 'navbackgroundbubble', NGPropertyMapped::MultiplicityScalar, false, 'solid f79646', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navcolorbubble', NGProperty::TypeString, self::DomainLayoutFlexR, 'navcolorbubble', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);

        $this->propertiesMapped [] = new NGPropertyMapped ('navpaddingter', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpaddingter', NGPropertyMapped::MultiplicityScalar, false, '8 15 8 15', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navfontter', NGProperty::TypeString, self::DomainLayoutFlexR, 'navfontter', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,13,false,false,false,828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navhovercolor', NGProperty::TypeString, self::DomainLayoutFlexR, 'navhovercolor', NGPropertyMapped::MultiplicityScalar, false, '000000', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navsuper', NGProperty::TypeBool, self::DomainLayoutFlexR, 'navsuper', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navcolumns', NGProperty::TypeInt, self::DomainLayoutFlexR, 'navcolumns', NGPropertyMapped::MultiplicityScalar, false, 4, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpicturespri', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpicturespri', NGPropertyMapped::MultiplicityScalar, false, 'Hidden', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpicturessec', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpicturessec', NGPropertyMapped::MultiplicityScalar, false, 'Hidden', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navpicturester', NGProperty::TypeString, self::DomainLayoutFlexR, 'navpicturester', NGPropertyMapped::MultiplicityScalar, false, 'Hidden', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navfillsec', NGProperty::TypeString, self::DomainLayoutFlexR, 'navfillsec', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navstylecart', NGProperty::TypeString, self::DomainLayoutFlexR, 'navstylecart', NGPropertyMapped::MultiplicityScalar, false, 'cartdefault', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navstyleaccount', NGProperty::TypeString, self::DomainLayoutFlexR, 'navstyleaccount', NGPropertyMapped::MultiplicityScalar, false, 'accountdefault', false);


        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatcherbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatcherfill', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatcherpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatchermargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatchermargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatchervisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'eyecatchervisible', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherpanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'eyecatcherpanorama', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherpicture', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatcherpicture', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherautoprogress', NGProperty::TypeInt, self::DomainLayoutFlexR, 'eyecatcherautoprogress', NGPropertyMapped::MultiplicityScalar, false, 5, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherheight', NGProperty::TypeInt, self::DomainLayoutFlexR, 'eyecatcherheight', NGPropertyMapped::MultiplicityScalar, false, 50, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherinheritance', NGProperty::TypeBool, self::DomainLayoutFlexR, 'eyecatcherinheritance', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatchermutevideo', NGProperty::TypeBool, self::DomainLayoutFlexR, 'eyecatchermutevideo', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherbulletstyle', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatcherbulletstyle', NGPropertyMapped::MultiplicityScalar, false, 'bulletdefault', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherbulletcolora', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatcherbulletcolora', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('eyecatcherbulletcolorb', NGProperty::TypeString, self::DomainLayoutFlexR, 'eyecatcherbulletcolorb', NGPropertyMapped::MultiplicityScalar, false, '000000', false);

        $this->propertiesMapped [] = new NGPropertyMapped ('headerbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'headerbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headerfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'headerfill', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headerpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'headerpadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headermargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'headermargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headervisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'headervisible', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('headerpanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'headerpanorama', NGPropertyMapped::MultiplicityScalar, false, false, false);

        $this->propertiesMapped [] = new NGPropertyMapped ('mainbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'mainbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('mainfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'mainfill', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('mainpanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'mainpanorama', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('mainsidebarmode', NGProperty::TypeString, self::DomainLayoutFlexR, 'mainsidebarmode', NGPropertyMapped::MultiplicityScalar, false, 'equal', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('mainmargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'mainmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);

        $this->propertiesMapped [] = new NGPropertyMapped ('leftbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'leftbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('leftpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'leftpadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('leftvisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'leftvisible', NGPropertyMapped::MultiplicityScalar, false, true, false);

        $this->propertiesMapped [] = new NGPropertyMapped ('contentbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'contentbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('contentpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'contentpadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);

        $this->propertiesMapped [] = new NGPropertyMapped ('rightbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'rightbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('rightpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'rightpadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('rightvisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'rightvisible', NGPropertyMapped::MultiplicityScalar, false, true, false);

        $this->propertiesMapped [] = new NGPropertyMapped ('footerbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'footerbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('footerfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'footerfill', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('footerpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'footerpadding', NGPropertyMapped::MultiplicityScalar, false, '10 10 10', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('footermargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'footermargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('footervisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'footervisible', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('footerpanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'footerpanorama', NGPropertyMapped::MultiplicityScalar, false, true, false);

        $this->propertiesMapped [] = new NGPropertyMapped ('commonbackground', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonbackground', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonfill', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonfill', NGPropertyMapped::MultiplicityScalar, false, 'solid 828282', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonpadding', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonpadding', NGPropertyMapped::MultiplicityScalar, false, '20', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonmargin', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonvisible', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commonvisible', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonpanorama', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commonpanorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonshowpages', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commonshowpages', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonshowfolders', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commonshowfolders', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonshowcontact', NGProperty::TypeBool, self::DomainLayoutFlexR, 'commonshowcontact', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonfolders', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonfolders', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,true,ebebeb', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonpages', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonpages', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,false,ebebeb', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonpageshover', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonpageshover', NGPropertyMapped::MultiplicityScalar, false, 'false,false,false,ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commontext', NGProperty::TypeString, self::DomainLayoutFlexR, 'commontext', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,15,false,false,false,ebebeb', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonlink', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonlink', NGPropertyMapped::MultiplicityScalar, false, 'true,false,false,ebebeb', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonhover', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonhover', NGPropertyMapped::MultiplicityScalar, false, 'true,false,false,ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonhtml', NGProperty::TypeFulltext, self::DomainLayoutFlexR, 'commonhtml', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commonpagesalignment', NGProperty::TypeString, self::DomainLayoutFlexR, 'commonpagesalignment', NGPropertyMapped::MultiplicityScalar, false, 'left', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('commoncontactalignment', NGProperty::TypeString, self::DomainLayoutFlexR, 'commoncontactalignment', NGPropertyMapped::MultiplicityScalar, false, 'right', false);
    }

    public function __construct()
    {
        parent::__construct();

        $this->setId(self::IdLayoutFlexR);
    }

    public function navlineheightpri()
    {
        $font = new NGFont ($this->navfontpri);
        return ceil($font->fontsize * 1.3);
    }

    public function navheightpri()
    {
        $padding = new NGMargin ($this->navpaddingpri);
        return $this->navlineheightpri() + $padding->totalHeight();
    }

    public function navheight()
    {
        $paddinginner = new NGMargin ($this->navpaddingpri);
        $paddingouter = new NGMargin($this->navpadding);
        $paddingcontainer = new NGMargin($this->navmargin);
        return $this->navlineheightpri() + $paddinginner->totalHeight() + $paddingouter->totalHeight() + $paddingcontainer->totalHeight();
    }

    public function navlineheightsec()
    {
        $font = new NGFont ($this->navfontsec);
        return ceil($font->fontsize * 1.3);
    }

    public function navextrapaddingrightpri()
    {
        $padding = new NGMargin ($this->navpaddingpri);
        return 24 + ($padding->individualMargins() ? $padding->right : $padding->all);
    }

    public function navextrapaddingrightsec()
    {
        $padding = new NGMargin ($this->navpaddingsec);
        return 24 + ($padding->individualMargins() ? $padding->right : $padding->all);
    }

    private static function isbright($data)
    {
        $parts = explode(' ', $data);

        if (($parts [0] === 'solid' || $parts[0] === 'gradient') && count($parts) > 1) {
            $r = hexdec(substr($parts[1], 0, 2));
            $g = hexdec(substr($parts[1], 2, 2));
            $b = hexdec(substr($parts[1], 4, 2));

            return $r + $g + $b > 383;
        }

        return false;
    }

    public function navbackgroundbrightpri()
    {
        return self::isbright($this->navbackgroundpri);
    }

    public function navbackgroundbrightsec()
    {
        return self::isbright($this->navbackgroundsec);
    }
}