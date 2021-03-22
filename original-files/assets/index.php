<?php

include_once './../classes/includes.php';

$downloadPump = new NGDownloadPump ();

$uid = NGUtil::get('ngu', '');
if ($uid !== '' && !NGUtil::checkUID($uid)) NGUtil::HeaderNotFound();
$downloadPump->uid = $uid;

$downloadPump->url = NGUtil::get ( 'ngq', '' );

$downloadPump->pumpDownload ();