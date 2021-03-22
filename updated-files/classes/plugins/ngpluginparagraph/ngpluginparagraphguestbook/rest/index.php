<?php 

include_once ('./../../../../includes.php');
include_once ('./../ngpluginparagraphguestbook.php');
include_once ('./../classes/ngguestbookpost.php');
include_once ('./../classes/ngguestbookrest.php');
include_once ('./../classes/recaptchalib.php');
include_once ('./../settings/ngguestbooksettings.php');

$rest = new NGGuestbookRest();

$rest->handle();