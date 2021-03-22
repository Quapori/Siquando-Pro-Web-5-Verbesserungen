<?php

include_once './../classes/includes.php';

$imagePump = new NGImagePump ();

$imagePump->url = NGUtil::get('ngq', '');

$uid = NGUtil::get('ngu', '');
if ($uid !== '' && !NGUtil::checkUID($uid)) NGUtil::HeaderNotFound();
$imagePump->uid = $uid;

$h = NGUtil::get('h', -1);
if (!is_numeric($h)) NGUtil::HeaderNotFound();
$h = intval($h);
if ($h < -1) NGUtil::HeaderNotFound();
if ($h === 0) NGUtil::HeaderNotFound();
if ($h > 1920) $h = 1920;
$imagePump->maxHeight = $h;

$w = NGUtil::get('w', -1);
if (!is_numeric($w)) NGUtil::HeaderNotFound();
$w = intval($w);
if ($w < -1) NGUtil::HeaderNotFound();
if ($w === 0) NGUtil::HeaderNotFound();
if ($w > 1920) $w = 1920;
$imagePump->maxWidth = $w;

$r = NGUtil::get('r', 0);
if (!is_numeric($r)) NGUtil::HeaderNotFound();
$r = intval($r);
if ($r < NGPicture::RatioNone || $r > NGPicture::Ratio1by2) NGUtil::HeaderNotFound();
$imagePump->ratio = $r;

$imagePump->pumpImage();