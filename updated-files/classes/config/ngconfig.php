<?php

/**
 * Global Configuration
 */
class NGConfig {
    const InstallationId='xxxxxxxxx';
    const DatabaseHost='xxxxxxxxx';
    const DatabaseUser='xxxxxxxxx';
    const DatabasePassword='xxxxxxxxx';
    const DatabaseSchema='xxxxxxxxx';
    const DatabasePort=3306;
    const DatabaseTablePrefix='sqp_';
    const DatabaseEngine='InnoDB';
    const DatabaseSqlBigSelects=true;
    const AdminPassword='xxxxxxxxx';
    const UserPassword='';
    const SystemPassword='xxxxxxxxx';
    const FolderStore='store';
    const FolderImages='images';
    const FolderAssets='assets';
    const FolderDownloads='downloads';
    const FolderContent='';
    const FolderPictures='pictures';
    const RootURL='https://xxxxxxxxx/';
    const SSLURL='';
    const HSTS='0';

    const DecimalSeparator=',';
    const ThousandsSeparator='.';
    const DateFormat='Y.m.d';
    const DateTimeFormatLocal='d.m.Y H:i:s';
    const DateFormatLocal='d.m.Y';
    const Generator='SIQUANDO Pro';

    const DatabaseVersion='1.0';
    const ShopDatabaseVersion='3.0';
    const ServerVersion='5.0';
    const ServerBuild='1200';
    const Product='SIQUANDO Pro 5';

    const DebugMode=false;
    const VanityURLs=true;
    const AcceptPHPExtension=true;
    const IsShop=false;
    const ForwardMissingTrailingSlash=true;

    const MailUseSMTP=true;
    const MailSMTPHost='xxxxxxxxx';
    const MailSMTPPort='xxxxxxxxx';
    const MailSMTPAuth=true;
    const MailSMTPUserName='xxxxxxxxx';
    const MailSMTPPassword='xxxxxxxxx';
    const MailSMTPSecure='xxxxxxxxx';

    public static function storePath() {
    	return realpath(dirname(__FILE__).'/../../'.self::FolderStore);
    }

    public static function templatePath() {
    	return realpath(dirname(__FILE__).'/../model/simple/templates');
    }

    public static function pluginsPath() {
    	return realpath(dirname(__FILE__).'/../plugins');
    }

    private static $rootPath;

    public static function getRootPath() {
        if (!isset(self::$rootPath)) self::$rootPath = parse_url(self::RootURL)['path'];
        return self::$rootPath;
    }
}

date_default_timezone_set(@date_default_timezone_get());