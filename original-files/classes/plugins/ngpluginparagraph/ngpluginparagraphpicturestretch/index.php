<?php

include_once './../../../includes.php';

NGSession::getInstance ()->stepsToRoot = 4;
NGSession::getInstance ()->currentPath = 'classes/plugins/ngpluginparagraph/ngpluginparagraphpicturestretch/';
NGSession::getInstance ()->user = NGUser::getUserSystem ();
NGDBConnector::getInstance ()->connect ();

if (!array_key_exists('uid', $_GET)) NGUtil::HeaderNotFound();

$uid = $_GET ['uid'];

$adapter = new NGDBAdapterObject();
$paragraphPictureStretch = $adapter->loadObject($uid, NGPluginParagraph::ObjectTypePluginParagraph,NGPluginParagraph::ObjectTypePluginParagraph);

if ($paragraphPictureStretch===null) NGUtil::HeaderNotFound();

$paragraphPictureStretch->previewMode = (NGUtil::get ( 'ngm', '' ) == 'p') ? true : false;
$paragraphPictureStretch->renderGallery();
