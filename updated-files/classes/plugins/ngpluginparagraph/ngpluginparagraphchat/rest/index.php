<?php

include_once '../../../../includes.php';
include_once '../ngpluginparagraphchat.php';


class NGChatController
{
    const TimeStamp = 'timestamp';
    const Nick = 'nick';
    const Line = 'line';
    const MinTimestamp = '00000000000000';

    /**
     * @var array Items
     */
    public $items = array();

    /**
     * @var NGDBAdapterObject
     */
    private $adapter;

    /**
     * @var NGPluginParagraphChatConversation
     */
    private $conversation;

    /**
     * @var NGPluginParagraphChat
     */
    private $paragraph;

    /**
     * @var string UID of paragraph
     */
    public $uidParagraph;

    /**
     * @var bool may the user write
     */
    private $writable = true;

    /**
     * @var NGAccess
     */
    private $access;


    /**
     * Load settings
     */
    private function load()
    {
        $this->conversation = $this->adapter->loadObject($this->uidParagraph, NGPluginParagraphChat::ObjectTypePluginParagraph, NGPluginParagraphChatConversation::ObjectTypePluginParagraphChatConversation);
        if ($this->conversation === null) $this->handleNotFound();

        $this->paragraph = $this->adapter->loadObject($this->uidParagraph, NGPluginParagraphChat::ObjectTypePluginParagraph, NGPluginParagraphChat::ObjectTypePluginParagraphChat);

        if ($this->conversation->items !== '') $this->items = json_decode($this->conversation->items, true);

        $this->writable = $this->access->checkAccess($this->paragraph->realms);
    }

    /**
     * Item was not found
     */
    public static function handleNotFound()
    {
        header("HTTP/1.1 404 Not Found");
        die();
    }

    /**
     * Generic error
     */
    public static function handleError()
    {
        header("HTTP/1.1 500 Internal Server Error");
        die();
    }


    /**
     * Save settings
     * @throws Exception
     */
    private function save()
    {
        $this->conversation->items = json_encode($this->items);
        $this->adapter->saveObject($this->conversation, '', false, false, true, false, false, false);
    }

    private function secondsToLive()
    {
        switch ($this->paragraph->archivetime) {
            case 'TenSeconds':
                return 10;
            case 'TenMinutes':
                return 10 * 60;
            case 'OneHour':
                return 60 * 60;
            case 'OneDay':
                return 24 * 60 * 60;
            case 'OneWeek':
                return 7 * 24 * 60 * 60;
            case 'OneMonth':
                return 31 * 24 * 60 * 60;
            case 'OneYear':
                return 365 * 24 * 60 * 60;
            case 'Indefinitely':
                return 3650 * 24 * 60 * 60;
            default:
                return 24 * 60 * 60;
        }
    }


    /**
     * Append an item
     *
     * @param $line
     * @param $nick
     */
    private function appendItem($line, $nick)
    {
        $this->items[] = array(
            self::TimeStamp => self::createTimestamp(),
            self::Line => $line,
            self::Nick => $nick
        );
    }

    /**
     * @param $string
     * @param $digits
     * @return string
     */
    static function pad($string, $digits)
    {
        return str_pad(substr($string, 0, $digits), $digits, '0', STR_PAD_LEFT);
    }

    /**
     * Create a timetamp
     * @return string
     */
    static function createTimestamp()
    {
        list ($useconds, $seconds) = explode(" ", microtime());

        $useconds = (int)($useconds * 10000);

        return self::pad($seconds, 10) . self::pad($useconds, 4);
    }

    /**
     * Send JSON Header
     */
    private function sendHeader()
    {
        header('Content-Type: application/json');
    }

    /**
     * Get response
     *
     * @param int $lastUID
     * @return array
     */
    private function getResponse($lastTimestamp = self::MinTimestamp)
    {
        $response = array();

        $items = array();

        foreach ($this->items as $item) {
            if ($item[self::TimeStamp] > $lastTimestamp) $items[] = $item;
        }

        $response['writable'] = NGUtil::boolToStringXML($this->writable);
        $response['items'] = $items;

        return $response;
    }

    /**
     * Send the response
     * @param $lastUID
     */
    private function sendResponse($lastTimestamp)
    {
        $respone = $this->getResponse($lastTimestamp);
        $this->sendHeader();
        echo(json_encode($respone));
    }

    /**
     * Trims items
     */
    private function trim()
    {
        $changed = false;

        $secondstolive = $this->secondsToLive();

        $cutoff = self::pad(time() - $secondstolive, 10) . '0000';

        $items = array();

        foreach ($this->items as $item) {
            if ($item[self::TimeStamp] > $cutoff) {
                $items[] = $item;
            } else {
                $changed = true;
            }
        }

        $this->items = $items;

        return $changed;
    }


    /**
     * Handle the request
     *
     * @throws NGDatabaseException
     */
    public function handleRequest()
    {
        NGSession::getInstance()->user = NGUser::getUserSystem();
        NGDBConnector::getInstance()->connect();

        $this->adapter = new NGDBAdapterObject();
        $this->access = new NGAccess();

        $line = NGUtil::post('line', '');
        $nick = NGUtil::post('nick', '');
        $lastTimestamp = NGUtil::post('lasttimestamp', self::MinTimestamp);
        $this->uidParagraph = NGUtil::post('uid', '');

        $this->load();

        $changed = $this->trim();

        if ($line !== '' && $this->writable) {
            $this->appendItem($line, $nick);
            $changed = true;
        }

        if ($changed) $this->save();

        $this->sendResponse($lastTimestamp);
    }
}

try {
    $controller = new NGChatController();
    $controller->handleRequest();
}
catch (Exception $ex) {
    NGChatController::handleError();
}