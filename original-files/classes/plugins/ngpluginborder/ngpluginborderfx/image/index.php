<?php
include_once './../../../../includes.php';

$session = NGSession::getInstance ();
$session->user = NGUser::getUserSystem ();
$session->stepsToRoot=5;
NGDBConnector::getInstance ()->connect ();

$fx=new NGPluginBorderFXStyle(NGUtil::get('f',''));

$fx->outputWidth=NGUtil::get('w', 600);
$fx->render(NGUtil::get('m','t'));