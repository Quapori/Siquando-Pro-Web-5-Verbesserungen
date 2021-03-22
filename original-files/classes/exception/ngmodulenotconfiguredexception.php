<?php

class NGModuleNotConfiguredException extends NGException
{
    public $modulename;

    public function __construct($modulename)
    {
        parent::__construct ( sprintf ( 'Module %s is not configured.', $modulename ), 30013 );
        $this->modulename=$modulename;
    }

    public function getAdditionalInfo()
    {
        return array(
            'modulename' => $this->modulename
        );
    }
}