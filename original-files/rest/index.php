<?php
include_once './../classes/includes.php';

NGUtil::XMLHeader();

NGSession::getInstance()->user=NGUser::getUserSystem();

$restController=new NGRestController();

echo($restController->restCall(NGUtil::gpc('action'), NGUtil::gpc('query'), NGUtil::gpc('sid')));