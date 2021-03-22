<?php
include_once './../../../../includes.php';
include_once './../ngpluginparagraphprotecteddownload.php';

class NGProtectedDownloadPump {

	public $code = '';

	/**
	 *
	 * @var NGDownloadPump
	 */
	private $downloadPump;

	/**
	 *
	 * @var NGPluginParagraphProtectedDownload
	 */
	private $paragraph;

	private function handleError() {
		if ($this->paragraph->errorpage !== '') {
			
			$link = new NGLink ();
			$link->previewMode = false;
			
			$link->linkType = NGLink::LinkPage;
			$link->uid = $this->paragraph->errorpage;
			
			$url = $link->getURL ();
			
			NGUtil::Forward ( $url, false );
		} else {
			NGUtil::HeaderNotFound ();
		}
	}

	public function handleDownload() {
		if ($this->code === '')
			NGUtil::HeaderNotFound ();
		
		$parts = explode ( '-', $this->code );
		
		if (count ( $parts ) !== 3)
			NGUtil::HeaderNotFound ();
		
		if (strlen ( $parts [0] ) !== 32 || strlen ( $parts [0] ) !== 32)
			NGUtil::HeaderNotFound ();
		
		$uid = $parts [0];
		$time = $parts [1];
		$sign = $parts [2];
		
		$now = time ();
		
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot = 5;
		NGSession::getInstance ()->currentPath = 'classes/plugins/ngpluginparagraph/ngpluginparagraphprotecteddownload/download/';
		NGDBConnector::getInstance ()->connect ();
		
		$adapter = new NGDBAdapterObject ();
		$this->paragraph = $adapter->loadObject ( $uid, NGPluginParagraph::ObjectTypePluginParagraph, NGPluginParagraphProtectedDownload::ObjectTypePluginParagraphProtectedDownload );
		
		if ($this->paragraph === null)
			NGUtil::HeaderNotFound ();
		
		if (! preg_match ( '/^[a-f0-9]+$/', $time ))
			$this->handleError ();
		
		$timecode = hexdec ( $time );
		
		if ($this->paragraph->validity > 0 && ($now > $timecode + $this->paragraph->validity + $this->paragraph->delay) || $now < $timecode)
			$this->handleError ();
		
		if (md5 ( $this->paragraph->objectUID . $this->paragraph->download . $this->paragraph->errorpage . $time . NGConfig::InstallationId ) !== $sign)
			$this->handleError ();
		
		$this->downloadPump = new NGDownloadPump ();
		$this->downloadPump->uid = $this->paragraph->download;
		$this->downloadPump->pumpDownload ();
	}
}

$protectedDownloadPump = new NGProtectedDownloadPump ();
$protectedDownloadPump->code = NGUtil::get ( 'c', '' );
$protectedDownloadPump->handleDownload ();