<?php

/**
 * Utility functions
 */
class NGUtil
{
    const ObjectUIDMin = 'w0000000000000000000000000000000';
    const ObjectUIDMax = 'wfffffffffffffffffffffffffffffff';
    const ObjectUIDRoot = 'w0000000000000000000000000000000';
    const ObjectUIDInherit = 'w1111111111111111111111111111111';
    const ObjectUIDRootUsersAndGroups = 'w0000000000000000000000000000003';
    const ObjectUIDRootContent = 'w0000000000000000000000000000004';
    const ObjectUIDRootPictures = 'w0000000000000000000000000000005';
    const ObjectUIDRootAssets = 'w0000000000000000000000000000006';
    const ObjectUIDRootSettings = 'w0000000000000000000000000000007';
    const ObjectUIDRootTrash = 'w0000000000000000000000000000012';
    const ObjectUIDRootHome = 'w0000000000000000000000000000013';
    const ObjectUIDRootCommon = 'w0000000000000000000000000000015';
    const ObjectUIDRootSpecial = 'w0000000000000000000000000000016';
    const ObjectUIDRootInfo = 'w0000000000000000000000000000017';
    const ObjectUIDRootTemplates = 'w0000000000000000000000000000019';
    const ObjectUIDRootLayoutPictures = 'w0000000000000000000000000000022';
    const ObjectUIDRootProducts = 'w0000000000000000000000000000024';

    const ObjectUIDHomePage = 'w0000000000000000000000000000014';
    const ObjectUIDSearchPage = 'w0000000000000000000000000000018';
    const ObjectUIDLoginPage = 'w0000000000000000000000000000023';

    const ObjectUIDTemplatePageA = 'w0000000000000000000000000000020';
    const ObjectUIDTemplatePageB = 'w0000000000000000000000000000021';

    const ObjectUIDSystem = 'w0000000000000000000000000000001';
    const ObjectUIDSystemGroup = 'w0000000000000000000000000000002';
    const ObjectUIDAdmin = 'w0000000000000000000000000000008';
    const ObjectUIDAdminGroup = 'w0000000000000000000000000000009';
    const ObjectUIDUser = 'w0000000000000000000000000000011';
    const ObjectUIDUsersGroup = 'w0000000000000000000000000000010';

    const ObjectTypeRoot = 'NGRoot';
    const ObjectTypeRootUsersAndGroups = 'NGRootUsersAndGroups';
    const ObjectTypeRootContent = 'NGRootContent';
    const ObjectTypeRootPictures = 'NGRootPictures';
    const ObjectTypeRootAssets = 'NGRootAssets';
    const ObjectTypeRootSettings = 'NGRootSettings';

    const DomainTrash = 'trash';
    const DomainCore = 'core';
    const DomainSEO = 'seo';
    const LanguageNeutral = '--';
    const LanguageDefault = '++';

    const UserSystem = 'system';

    const LanguageResourcesMain = 'xml/langmain.xml';

    const UIDPrefix = 'w';

    const UserAgent = 'HTTP_USER_AGENT';
    const NGLayout = 'nglayout';
    const Mobile = 'mobile';
    const Plain = 'plain';
    const Desktop = 'desktop';

    const SafeChars = 'abcdefghijklmnopqrstuvwxyz1234567890.';

    const MetaSiteId = 'site_id';
    const MetaDatabaseVersion = 'database_version';
    const MetaShopDatabaseVersion = 'shopdatabase_version';

    const SessionName = 'ngsession';

    private static $isMobile;

    private static $sessionStarted = false;

    public static function compressHTML($html)
    {
        return preg_replace('/[\s]+/s', ' ', $html);
    }

    public static function compressCSS($html)
    {
        return self::compressHTML($html);
    }

    /**
     *
     * Sends the default headers
     */
    public static function DefaultHTMLHeaders()
    {
        header('Content-Type: text/html; charset=utf-8');
        header('X-UA-Compatible: IE=Edge');

        if (NGSettingsSite::getInstance()->showmobile) {
            header('Vary: User-Agent');
        }

        if (NGConfig::HSTS > 0) {
            header(sprintf('Strict-Transport-Security: max-age=%u; preload', NGConfig::HSTS));
        }
    }

    public static function XMLHeader()
    {
        header('Content-Type:text/xml; charset=utf-8');
    }

    /**
     *
     * Forward to an url
     * @param string $url
     * @param string $previewMode
     */
    public static function Forward($url, $previewMode)
    {
        if (!$previewMode)
            header('Location: ' . $url);
        echo(sprintf('<!DOCTYPE html><html><head><title>Content moved</title><meta http-equiv="Refresh" content="0; URL=%s"></head><body></body></html>', htmlentities($url)));
        exit ();
    }

    /**
     *
     * Handles an etag
     * @param string $tag
     */
    public static function handleEtag($tag)
    {

        $etag = '"' . md5($tag) . '"';
        if (isset ($_SERVER ['HTTP_IF_NONE_MATCH'])) {
            if ($_SERVER ['HTTP_IF_NONE_MATCH'] == $etag) {
                header('Etag: ' . $etag);
                header('HTTP/1.1 304 Not Modified');
                exit ();
            }
        }
        header('Etag: ' . $etag);
    }

    /**
     *
     * Create a random token
     *
     * @return string
     */
    public static function createToken()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0987654321';
        $result = '';

        for ($i = 0; $i < 32; $i++) {
            $pos = rand(0, strlen($chars) - 1);
            $result .= substr($chars, $pos, 1);
        }

        return $result;
    }


    /**
     * Create a worldwide unique Identifier
     *
     * @return string 32-digit UID
     */
    public static function createUID($timeStamp = 0)
    {
        if ($timeStamp === 0) {

            list ($strUseconds, $strSeconds) = explode(" ", microtime());

            $uSeconds = ( float )$strUseconds;
            $seconds = ( int )$strSeconds;

            $iUSeconds = ( int )($uSeconds * 1000000);

            $now = getdate($seconds);
        } else {
            $now = getdate($timeStamp);
            $iUSeconds = 0;
        }

        $year = self::hexBlock($now ['year'], 3);
        $month = self::hexBlock($now ['mon'], 1);
        $day = self::hexBlock($now ['mday'], 2);
        $hour = self::hexBlock($now ['hours'], 2);
        $minute = self::hexBlock($now ['minutes'], 2);
        $second = self::hexBlock($now ['seconds'], 2);
        $ticks = self::hexBlock($iUSeconds, 5);

        usleep(100);

        return self::UIDPrefix . $year . $month . $day . $hour . $minute . $second . $ticks . NGConfig::InstallationId;
    }

    private static function hexBlock($value, $digits)
    {
        return str_pad(dechex($value), $digits, '0', STR_PAD_LEFT);
    }

    /**
     * Converts int to bool
     * @param int $int int to be converted
     * @return bool  resulting bool
     */
    public static function stringToBool($string)
    {
        return ($string == '1') ? true : false;
    }

    /**
     *
     * Converts bool to date int
     * @param bool $bool
     * @return int Converted value
     */
    public static function boolToInt($bool)
    {
        return ($bool) ? 1 : 0;
    }

    /**
     *
     * Convert bool to date XML bool string
     * @param bool $bool
     * @return string Converted value
     */
    public static function boolToStringXML($bool)
    {
        return ($bool) ? 'true' : 'false';
    }

    /**
     *
     * Converts XML bool string to bool
     * @param string $string
     * @return bool Converted value
     */
    public static function StringXMLToBool($string)
    {
        return ($string == 'true');
    }

    /**
     *
     * Gets the current time in correct format
     * @return string current time
     */
    public static function now()
    {
        return date(DATE_ATOM);
    }

    /**
     *
     * Access GET parameter
     * @param string $key Key of parameter
     * @return string Parameter
     */
    public static function get($key, $default = '')
    {
        return (array_key_exists($key, $_GET)) ? $_GET [$key] : $default;
    }

    /**
     *
     * Access POST parameter
     * @param string $key Key of parameter
     * @return string Parameter
     */
    public static function post($key, $default = '')
    {
        return (array_key_exists($key, $_POST)) ? $_POST [$key] : $default;
    }

    /**
     *
     * Access cookie parameter
     * @param string $key Key of parameter
     * @return string Parameter
     */
    public static function cookie($key)
    {
        return $_COOKIE [$key];
    }

    /**
     *
     * Checks GET, POST and COOKIE
     * @param unknown_type Key of paramete
     * @return string Found value
     */
    public static function gpc($key)
    {
        if (array_key_exists($key, $_GET))
            return self::get($key);
        if (array_key_exists($key, $_POST))
            return self::post($key);
        if (array_key_exists($key, $_COOKIE))
            return self::cookie($key);
        return null;
    }

    /**
     *
     * Unlinks a file without error
     * @param string $fullPath
     */
    public static function TryUnlink($fullPath)
    {
        try {
            @unlink($fullPath);
        } catch (Exception $ex) {
        }
    }

    /**
     *
     * Removes a dir without error
     * @param string $fullPath
     */
    public static function TryRmDir($fullPath)
    {
        try {
            @rmdir($fullPath);
        } catch (Exception $ex) {
        }
    }

    /**
     *
     * Empties a folder
     * @param string $path Folder to empty
     */
    public static function emptyFolder($path)
    {
        /* @var $dir Directory */

        $dir = @dir($path);

        $entry = $dir->read();

        while ($entry !== false) {
            if ($entry != '.' && $entry != '..') {
                $fullpath = $path . '/' . $entry;
                if (is_dir($fullpath)) {
                    self::emptyFolder($fullpath);
                    self::TryRmDir($fullpath);
                }
                if (is_file($fullpath)) {
                    self::TryUnlink($fullpath);
                }
            }
            $entry = $dir->read();
        }
        $dir->close();
    }

    /**
     *
     * Joins to paths
     * @param string $leftPath
     * @param string $rightPath
     */
    public static function joinPaths($leftPath, $rightPath)
    {
        if (substr($leftPath, -1) === '/')
            $leftPath = substr($leftPath, 0, -1);
        if (substr($rightPath, 0, 1) === '/')
            $rightPath = substr($rightPath, 1);
        return $leftPath . '/' . $rightPath;
    }

    /**
     *
     * Prepends the path to the root
     * @param string $path
     */
    public static function prependRootPath($path)
    {
        return self::joinPaths(NGSession::getInstance()->pathToRoot(), $path);
    }

    /**
     *
     * Prepends the images path
     * @param string $path
     */
    public static function prependImagesPath($path)
    {
        return self::prependRootPath(self::joinPaths(NGConfig::FolderImages, $path));
    }

    /**
     *
     * Prepends the assets path
     * @param string $path
     */
    public static function prependAssetsPath($path)
    {
        return self::prependRootPath(self::joinPaths(NGConfig::FolderAssets, $path));
    }

    /**
     *
     * Prepends the path to the store
     * @param unknown_type $path
     */
    public static function prependStorePath($path)
    {
        return self::prependRootPath(self::joinPaths(NGConfig::FolderStore, $path));
    }

    public static function pathForUID($objectUID)
    {
        $path = '/';

        for ($i = 1; $i < 9; $i += 2) {
            $path = NGUtil::joinPaths($path, substr($objectUID, $i, 2));
        }

        $path = NGUtil::joinPaths($path, $objectUID);
        $path = NGUtil::joinPaths($path, '/');

        return $path;
    }

    /**
     *
     * Recursivly creates path
     * @param string $basePath containing path
     * @param string $newPath new path
     */
    public static function createPath($basePath, $newPath)
    {
        $parts = explode('/', $newPath);
        $fullPath = $basePath;

        foreach ($parts as $part) {
            $fullPath = self::joinPaths($fullPath, $part);
            try {
                if (!is_dir($fullPath)) {
                    mkdir($fullPath);
                }
            } catch (Exception $ex) {
            }
        }

        return $fullPath;
    }

    /**
     *
     * Checks if a dir is empty
     * @param string $dir
     */
    public static function isEmptyDir($dir)
    {
        return (($files = @scandir($dir)) && count($files) <= 2);
    }

    public static function getAlternativeValue($value)
    {
        $parts = explode('.', $value);

        $partcount = count($parts);

        if ($partcount === 1) {
            $parts [] = '1';
        } else if ($partcount === 2) {
            if (is_numeric($parts [$partcount - 1])) {
                $parts [$partcount - 1]++;
            } else {
                $parts = self::array_insert($parts, '1', $partcount - 1);
            }
        } else {
            if (is_numeric($parts [$partcount - 1])) {
                $parts [$partcount - 1]++;
            } else {
                if (is_numeric($parts [$partcount - 2])) {
                    $parts [$partcount - 2]++;
                } else {
                    $parts = self::array_insert($parts, '1', $partcount - 2);
                }
            }
        }

        return join('.', $parts);
    }

    private static function array_insert($array, $new_element, $index)
    {
        $start = array_slice($array, 0, $index);
        $end = array_slice($array, $index);
        $start [] = $new_element;
        return array_merge($start, $end);
    }

    /**
     *
     * Sorts paragraphs by manual sort function
     * @param array $paragraphs
     */
    public static function sortItems($items, $sortManual)
    {
        $result = array();

        $objectUIDs = explode(' ', $sortManual);

        // first look for manually sorted items


        foreach ($objectUIDs as $objectUID) {
            foreach ($items as $item) {
                /* @var $item NGObject */
                if ($item->objectUID == $objectUID) {
                    $result [] = $item;
                    break;
                }
            }
        }

        // add everything without manual sort information


        foreach ($items as $item) {
            /* @var $item NGObject */
            if (!in_array($item->objectUID, $objectUIDs))
                $result [] = $item;
        }

        return $result;
    }

    public static function HeaderNotFound()
    {
        header("HTTP/1.1 404 Not Found");
        NGPluginErrorPage::render(404);
        die ();
    }

    public static function HeaderForbidden()
    {
        header('HTTP/1.1 403 Forbidden');
        NGPluginErrorPage::render(403);
        die ();
    }

    public static function WriteIndexCopperplate($path) {
        file_put_contents(self::joinPaths($path, 'index.php'), "<?php header('HTTP/1.1 403 Forbidden');");
    }

    public static function HeaderMovedPermanently($url)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header(sprintf('Location: %s', $url));
        die();
    }


    /**
     *
     * Convert id to uid
     * @param string $prefix
     * @param string $id
     */
    public static function idToUID($prefix, $id)
    {
        $uid = $prefix;

        for ($pos = 0; $pos < 14; $pos++) {
            if ($pos > strlen($id) - 1) {
                $uid .= '00';
            } else {
                $uid .= str_pad(dechex(ord(substr($id, $pos, 1))), 2, '0', STR_PAD_LEFT);
            }
        }

        return $uid;
    }

    /**
     *
     * Remove bad stuff from filename
     * @param string $filename
     */
    public static function safeFilename($filename)
    {
        return str_replace(array('/', '\\'), '', $filename);
    }

    /**
     *
     * A filename you can put on the server without trouble
     * @param string $filename
     */
    public static function extraSafeFilename($filename)
    {
        $out = '';

        $in = strtolower($filename);

        for ($i = 0; $i < strlen($in); $i++) {
            $s = substr($in, $i, 1);

            if (strpos(self::SafeChars, $s) === false) {
                $out .= '-';
            } else {
                $out .= $s;
            }
        }

        if (NGUtil::endswith($out, '.php') || NGUtil::endswith($out, '.php3') || NGUtil::endswith($out, '.php3'))
            $out .= '.txt';

        $out = trim($out, '.');

        return $out;
    }

    /**
     *
     * Checks if a string ends with
     * @param string $haystack
     * @param string $needle
     */
    public static function endswith($haystack, $needle)
    {
        return substr($haystack, -strlen($needle)) == $needle;
    }

    /**
     *
     * Gets the relative path
     * @param string $path
     */
    public static function relativePathFromCurrentPath($path)
    {
        return NGUtil::combineAbsolutePaths(NGSession::getInstance()->currentPath, $path);
    }

    /**
     *
     * Generate a relative path from to absolute paths
     * @param string $fromPath where we are coming from
     * @param string $toPath where we are going to
     * @return string comined path
     */
    public static function combineAbsolutePaths($fromPath, $toPath)
    {

        $toPathParts = explode('/', $toPath);
        $fromPathParts = explode('/', $fromPath);

        if (count($toPathParts) > 0 && $toPathParts [0] === '')
            array_shift($toPathParts);
        if (count($fromPathParts) > 0 && $fromPathParts [0] === '')
            array_shift($fromPathParts);

        // Find common parts


        $commonPartCount = 0;

        for ($i = 0; $i < max(sizeof($toPathParts) - 1, sizeof($fromPathParts) - 1); $i++) {
            if (isset ($toPathParts [$i]) && isset ($fromPathParts [$i])) {
                if ($toPathParts [$i] == $fromPathParts [$i]) {
                    $commonPartCount++;
                } else {
                    break;
                }
            } else {
                break;
            }
        }

        $relativeParts = array();

        // Go back


        if (sizeof($fromPathParts) > $commonPartCount + 1) {
            $replacement_count = sizeof($fromPathParts) - $commonPartCount - 1;
            $relativeParts = array_fill(0, $replacement_count, '..');
        }

        // Go up


        if (sizeof($toPathParts) > $commonPartCount) {
            $remaining_to_path_parts = array_slice($toPathParts, $commonPartCount);
            $relativeParts = array_merge($relativeParts, $remaining_to_path_parts);
        }

        // Join


        // $relativeParts = array_merge ( array ( '.' ), $relativeParts );


        return implode('/', $relativeParts);

    }

    public static function leftOfSeparator($value, $separator)
    {
        $pos = strpos($value, $separator);

        if ($pos === false) {
            return $value;
        } else {
            return substr($value, 0, $pos);
        }
    }

    /**
     *
     * Joins to command separated values
     * @param string $first
     * @param string $second
     */
    public static function joinCommaSeparatedValues($first, $second)
    {
        $out = Array();
        $firstParts = explode(',', $first);
        $secondParts = explode(',', $second);

        foreach ($firstParts as $firstPart) {
            $firstPartTrimmed = trim($firstPart);
            if ($firstPartTrimmed !== '')
                $out [] = $firstPartTrimmed;
        }

        foreach ($secondParts as $secondPart) {
            $secondPartTrimmed = trim($secondPart);
            if ($secondPartTrimmed !== '') {
                if (array_search($secondPartTrimmed, $out) === false)
                    $out [] = $secondPartTrimmed;
            }
        }

        return join(', ', $out);
    }

    /**
     *
     * Is current date between to dates
     * @param string $dateStringFrom
     * @param string $dateStringTo
     */
    public static function isCurrentDateBetween($dateStringFrom, $dateStringTo)
    {
        if ($dateStringFrom === '' && $dateStringTo === '') {
            return true;
        } else if ($dateStringFrom !== '' && $dateStringTo === '') {
            return (NGSession::getInstance()->callTimestamp >= strtotime($dateStringFrom));
        } else if ($dateStringFrom === '' && $dateStringTo !== '') {
            return (NGSession::getInstance()->callTimestamp <= strtotime($dateStringTo));
        } else if ($dateStringFrom !== '' && $dateStringTo !== '') {
            return (NGSession::getInstance()->callTimestamp >= (strtotime($dateStringFrom)) && (time() <= strtotime($dateStringTo)));
        }
    }

    /***
     * Gets the next date
     */
    public static function nextDate($firstDate, $secondDate)
    {

        $firstValid = $firstDate !== '';
        $secondValid = $secondDate !== '';

        if ($firstValid) {
            if (NGSession::getInstance()->callTimestamp > strtotime($firstDate))
                $firstValid = false;
        }
        if ($secondValid) {
            if (NGSession::getInstance()->callTimestamp > strtotime($secondDate))
                $secondValid = false;
        }

        if (!$firstValid && !$secondValid) {
            return '';
        } else if ($firstValid && !$secondValid) {
            return $firstDate;
        } else if (!$firstValid && $secondValid) {
            return $secondDate;
        } else {
            return ($firstDate < $secondDate) ? $firstDate : $secondDate;
        }
    }

    /**
     *
     * Is it a mobile phone, the user is visiting with?
     */
    public static function isMobile()
    {

        if (isset (self::$isMobile)) {
            return self::$isMobile;
        }

        if (array_key_exists(self::NGLayout, $_GET)) {
            if ($_GET [self::NGLayout] == self::Mobile) {
                self::$isMobile = true;
                return true;
            }
        }

        if (!NGSettingsSite::getInstance()->showmobile) {
            self::$isMobile = false;
            return false;
        }

        if (array_key_exists(self::NGLayout, $_COOKIE)) {
            if ($_COOKIE [self::NGLayout] == self::Mobile) {
                self::$isMobile = true;
                return true;
            }
            if ($_COOKIE [self::NGLayout] == self::Desktop) {
                self::$isMobile = false;
                return false;
            }
        }

        if (array_key_exists(self::UserAgent, $_SERVER)) {
            foreach (NGSettingsSite::getInstance()->mobileagents as $mobileAgent) {
                if (strpos($_SERVER [self::UserAgent], $mobileAgent) !== false) {
                    self::$isMobile = true;
                    return true;
                }
            }
        }

        self::$isMobile = false;
        return false;
    }

    /**
     *
     * Render plaintext?
     */
    public static function isPlain()
    {
        if (array_key_exists(self::NGLayout, $_GET)) {
            if ($_GET [self::NGLayout] == self::Plain)
                return true;
        }

        return false;
    }

    /**
     *
     * Is this a valid Email?
     * @param string $email
     */
    public static function checkEmail($email)
    {
        return preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-.]+\.([a-zA-Z]{2,63})$/", $email);
    }

    /**
     *
     * Check for UID
     *
     * @param $uid
     * @return bool
     */
    public static function checkUID($uid)
    {
        return preg_match("/^w[a-f0-9]{31}$/", $uid);
    }

    /**
     * @param $token
     * @return bool
     */
    public static function checkToken($token)
    {
        return preg_match("/^[a-zA-Z0-9]{32}$/", $token);
    }


    /**
     *
     * Replace pipe
     * @param sting $value
     */
    public static function unescapePipe($value)
    {
        return str_replace('&#124;', '|', $value);
    }

    /**
     *
     * Replace tilde
     * @param sting $value
     */
    public static function unescapeTilde($value)
    {
        return str_replace('&#126;', '~', $value);
    }

    /**
     *
     * Replace Comma
     * @param sting $value
     */
    public static function unescapeComma($value)
    {
        return str_replace('&#44;', ',', $value);
    }

    /**
     * Splits a string, returns empty array, if string is empty
     *
     * @param $value
     * @param string $delimiter
     * @return array
     */
    public static function split($value, $delimiter = '|')
    {
        if ($value === '') {
            return array();
        } else {
            return explode($delimiter, $value);
        }
    }

    /**
     *
     * Starts a session
     */
    public static function startSession()
    {
        if (self::$sessionStarted)
            return;
        session_name(self::SessionName);

        if (array_key_exists(NGUtil::SessionName, $_GET))
            session_id($_GET [NGUtil::SessionName]);

        session_start();
        self::$sessionStarted = true;
    }

    /**
     *
     * Formats a currency
     * @param int $price
     */
    public static function formatCurrency($price)
    {
        return number_format(round($price / 100, 2), 2, ',', '.');
    }

    /**
     *
     * Formats a number for JSON
     *
     * @param $price
     * @return string
     */
    public static function formatCurrencyJson($price)
    {
        return number_format($price, 2, '.', '');
    }

    /**
     *
     * Creates an element and appends it
     * @param DOMElement $parentElement Element to append to
     * @param string $name Name of Element
     * @param string $value Value of Element
     * @param array $attributes Associative array of attributes
     * @return DOMElement
     */
    public static function appendElement(DOMElement $parentElement, $name, $value = null, array $attributes = array())
    {
        $element = $parentElement->ownerDocument->createElement($name);
        if ($value !== null) {
            $textNode = $parentElement->ownerDocument->createTextNode($value);
            $element->appendChild($textNode);
        }

        $parentElement->appendChild($element);
        self::appendAttributes($element, $attributes);

        return $element;
    }

    /**
     *
     * Creates and appends multiple attributes
     * @param DOMElement $parentElement Element to append to
     * @param array $attributes Associative array of Attributes
     */
    public static function appendAttributes(DOMElement $parentElement, array $attributes)
    {
        foreach ($attributes as $name => $value) {
            self::appendAttribute($parentElement, $name, $value);
        }
    }

    /**
     *
     * Creates and appends an attribute
     * @param DOMElement $parentElement Element to append to
     * @param unknown_type $name Name of Attribute
     * @param unknown_type $value Value of Attribute
     */
    public static function appendAttribute(DOMElement $parentElement, $name, $value)
    {
        $parentElement->setAttribute($name, $value);
    }

}

/**
 *
 * Picture size
 *
 */
class NGSize
{
    /**
     *
     * Width of picture
     * @var int
     */
    public $width = 0;

    /**
     *
     * Height of picture
     * @var int
     */
    public $height = 0;

    /**
     *
     * Creates a new size
     * @param int $width
     * @param int $height
     */
    public static function create($width, $height)
    {
        $size = new NGSize ();
        $size->width = $width;
        $size->height = $height;

        return $size;
    }
}

/**
 *
 * Crop information
 *
 */
class NGCrop
{
    /**
     *
     * Pixels left
     * @var int
     */
    public $left = 0;

    /**
     *
     * Pixels top
     * @var int
     */
    public $top = 0;

    /**
     *
     * Pixels right
     * @var int
     */
    public $right = 0;

    /**
     *
     * Pixels bottom
     * @var int
     */
    public $bottom = 0;

    /**
     *
     * This is a caluclated (default) crop
     * @var int
     */
    public $isDefault = false;

    /**
     *
     * Static convenience constructor
     * @param int $left
     * @param int $top
     * @param int $right
     * @param int $bottom
     * @param int $isDefault
     */
    public static function create($left, $top, $right, $bottom, $isDefault)
    {
        $crop = new NGCrop ();
        $crop->left = $left;
        $crop->top = $top;
        $crop->right = $right;
        $crop->bottom = $bottom;
        $crop->isDefault = $isDefault;

        return $crop;
    }

    public static function convertMargin($margin)
    {
        return $margin . 'px';
    }
}