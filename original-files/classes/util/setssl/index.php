<?php
include_once './../../includes.php';
$url = ($_GET ['ngproto'] == 'ssl' && NGConfig::SSLURL != '') ? NGConfig::SSLURL : NGConfig::RootURL;
$forward = $_GET ['ngurl'];
if (array_key_exists ( NGUtil::SessionName, $_COOKIE ))
	$forward .= ((strpos ( $forward, '?' ) === false) ? '?' : '&') . NGUtil::SessionName . '=' . $_COOKIE [NGUtil::SessionName];
$forward .= ((strpos ( $forward, '?' ) === false) ? '?' : '&') . 'ngsetproto=1';

NGUtil::Forward(NGUtil::joinPaths ( $url, $forward ), false);