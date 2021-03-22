<?php

include_once './classes/includes.php';

NGSession::getInstance ()->user = NGUser::getUserSystem ();
NGDBConnector::getInstance ()->connect ();

$robots = new NGRenderRobots ();
$robots->renderRobots ();