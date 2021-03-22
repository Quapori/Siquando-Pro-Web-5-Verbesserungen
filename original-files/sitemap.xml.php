<?php

include_once './classes/includes.php';

NGSession::getInstance ()->user = NGUser::getUserSystem ();
NGDBConnector::getInstance ()->connect ();

$sitemap = new NGRenderSitemap ();
$sitemap->renderSitemap ();