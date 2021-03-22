<?php

function NGAutoloadFilename($class) {
	switch ($class) {
		case 'iNGDBCreatesSQL': return 'db/ingdbcreatessql';
        case 'iNGDBCreatesAlterSQL': return 'db/ingdbcreatesaltersql';
		case 'NGUser': return 'model/simple/nguser';
		case 'NGAccount': return 'model/simple/ngaccount';
		case 'NGSession': return 'session/ngsession';
		case 'NGUtil': case 'NGCrop': case 'NGSize': return 'util/ngutil';
		case 'NGFontUtil': return 'util/ngfontutil';
		case 'NGMail': return 'util/ngmail';
		case 'NGImage': return 'util/ngimage';
		case 'NGLink': return 'util/nglink';
		case 'NGImagePump': return 'util/ngimagepump';
		case 'NGConfigPermissions': return 'config/ngconfigpermissions';
		case 'NGDownloadPump': return 'util/ngdownloadpump';
		case 'NGRichText': return 'util/ngrichtext';
		case 'NGTemplate': return 'util/ngtemplate';
		case 'NGMargin': return 'util/ngmargin';
		case 'NGFont': return 'util/ngfont';
		case 'NGAccess': return 'util/ngaccess';
		case 'NGNavigation': case 'NGNavItem': return 'util/ngnavigation';
		case 'NGRenderTag': return 'renderer/ngrendertag';
		case 'NGRenderStyle': return 'renderer/ngrenderstyle';
		case 'NGRenderNavigation': return 'renderer/ngrendernavigation';
		case 'NGRenderA': return 'renderer/ngrendera';
		case 'NGRenderPage': return 'renderer/ngrenderpage';
		case 'NGRenderBreadcrumbs': return 'renderer/ngrenderbreadcrumbs';
		case 'NGRenderCSS': return 'renderer/ngrendercss';
		case 'NGRenderSitemap': return 'renderer/ngrendersitemap';
		case 'NGRenderRobots': return 'renderer/ngrenderrobots';
		case 'NGSession': return 'session/ngsession';
		case 'NGObject': return 'model/base/ngobject';
		case 'NGObjectNamed': return 'model/base/ngobjectnamed';
		case 'NGObjectNamedSummary': return 'model/base/ngobjectnamedsummary';
		case 'NGObjectNamedSummaryPicture': return 'model/base/ngobjectnamedsummarypicture';
		case 'NGObjectChange': return 'model/base/ngobjectchange';
		case 'NGProperty': return 'model/base/ngproperty';
		case 'NGPropertyChange': return 'model/base/ngpropertychange';
		case 'NGPropertyCriteria': return 'model/base/ngpropertycriteria';
		case 'NGBouquet': case 'NGBouquetItem': return 'model/base/ngbouquet';
		case 'NGGrantChange': return 'model/base/nggrantchange';
		case 'NGObjectMapped': return 'model/base/ngobjectmapped';
		case 'NGPropertyMapped': return 'model/base/ngpropertymapped';
		case 'NGFileState': return 'model/base/ngfilestate';
		case 'NGSetting': return 'model/base/ngsetting';
		case 'NGSecurityPrincipal': return 'model/simple/ngsecurityprincipal';
		case 'NGUser': return 'model/simple/nguser';
		case 'NGGroup': return 'model/simple/nggroup';
		case 'NGFolder': return 'model/simple/ngfolder';
		case 'NGTopic': return 'model/simple/ngtopic';
		case 'NGFile': return 'model/simple/ngfile';
		case 'NGPicture': return 'model/simple/ngpicture';
		case 'NGDownload': return 'model/simple/ngdownload';
		case 'NGPluginPage': return 'plugins/ngpluginpage/ngpluginpage';
		case 'NGPluginParagraph': return 'plugins/ngpluginparagraph/ngpluginparagraph';
		case 'NGPluginBorderStandard': return 'plugins/ngpluginborder/ngpluginborderstandard/ngpluginborderstandard';
		case 'NGPluginBorderStandardSettings': return 'plugins/ngpluginborder/ngpluginborderstandard/settings/ngpluginborderstandardsettings';
		case 'NGPluginBorderFXStyle': case 'NGPluginBorderFX': return 'plugins/ngpluginborder/ngpluginborderfx/ngpluginborderfx';
		case 'NGPluginLayout': return 'plugins/ngpluginlayout/ngpluginlayout';
		case 'NGPluginTypographySettings': return 'plugins/ngplugintypography/settings/ngplugintypographysettings';
		case 'NGPluginNavigation': return 'plugins/ngpluginnavigation/ngpluginnavigation';
		case 'NGPluginEyecatcher': return 'plugins/ngplugineyecatcher/ngplugineyecatcher';
		case 'NGPluginSubNavigation': return 'plugins/ngpluginsubnavigation/ngpluginsubnavigation';
		case 'NGPluginTeaser': return 'plugins/ngpluginteaser/ngpluginteaser';
		case 'NGParagraphStream': return 'model/simple/ngparagraphstream';
		case 'NGDBConnector': return 'db/ngdbconnector';
		case 'NGDBAdapterObject': return 'db/ngdbadapterobject';
		case 'NGDBAdapterSchema': return 'db/ngdbadapterschema';
		case 'NGDBSchemaColumn': return 'db/schema/ngdbschemacolumn';
		case 'NGDBSchemaTable': return 'db/schema/ngdbschematable';
		case 'NGDBSchemaKey': return 'db/schema/ngdbschemakey';
		case 'NGDBSchemaDropTable': return 'db/schema/ngdbschemadroptable';
		case 'NGDBSchemaSchema': return 'db/schema/ngdbschemaschema';
		case 'NGDBQuery': return 'db/query/ngdbquery';
		case 'NGDBQueryWhere': return 'db/query/ngdbquerywhere';
		case 'NGDBQuerySelect': return 'db/query/ngdbqueryselect';
		case 'NGDBQueryInsert': return 'db/query/ngdbqueryinsert';
		case 'NGDBQueryUpdate': return 'db/query/ngdbqueryupdate';
		case 'NGDBQueryDelete': return 'db/query/ngdbquerydelete';
		case 'NGDBQPartCriteria': return 'db/qpart/ngdbqpartcriteria';
		case 'NGDBQPartCriteriaWhere': return 'db/qpart/ngdbqpartcriteriawhere';
		case 'NGDBQPartTableColumn': return 'db/qpart/ngdbqparttablecolumn';
		case 'NGDBQPartTableColumnAs': return 'db/qpart/ngdbqparttablecolumnas';
		case 'NGDBQPartOrderColumn': return 'db/qpart/ngdbqpartordercolumn';
		case 'NGDBQPartTableAs': return 'db/qpart/ngdbqparttableas';
		case 'NGDBQPartFunctionAs': return 'db/qpart/ngdbqpartfunctionas';
		case 'NGDBQPartJoin': return 'db/qpart/ngdbqpartjoin';
		case 'NGDBQPartOn': return 'db/qpart/ngdbqparton';
		case 'NGDBQPartLeft': return 'db/qpart/ngdbqpartleft';
		case 'NGDBQPartAliasColumn': return 'db/qpart/ngdbqpartaliascolumn';
		case 'NGDBQPartAliasColumnAs': return 'db/qpart/ngdbqpartaliascolumnas';
		case 'NGRest': return 'rest/ngrest';
		case 'NGRestController': return 'rest/ngrestcontroller';
		case 'NGRestException': return 'rest/ngrestexception';
		case 'NGRestObjectBase': return 'rest/ngrestobjectbase';
		case 'NGRestLoadObject': return 'rest/ngrestloadobject';
		case 'NGRestLoadObjectChange': return 'rest/ngrestloadobjectchange';
		case 'NGRestLoadObjectChanges': return 'rest/ngrestloadobjectchanges';
		case 'NGRestSaveObject': return 'rest/ngrestsaveobject';
		case 'NGRestSaveObjectChange': return 'rest/ngrestsaveobjectchange';
		case 'NGRestDeleteObject': return 'rest/ngrestdeleteobject';
		case 'NGRestQueryObjects': return 'rest/ngrestqueryobjects';
		case 'NGRestServertime': return 'rest/ngrestservertime';
		case 'NGRestCreateUID': return 'rest/ngrestcreateuid';
		case 'NGRestEcho': return 'rest/ngrestecho';
		case 'NGRestPutFile': return 'rest/ngrestputfile';
		case 'NGRestLogin': return 'rest/ngrestlogin';
		case 'NGRestLogout': return 'rest/ngrestlogout';
		case 'NGRestLoadChildObjects': return 'rest/ngrestloadchildobjects';
		case 'NGRestTrashObject': return 'rest/ngresttrashobject';
		case 'NGRestUnTrashObject': return 'rest/ngrestuntrashobject';
		case 'NGRestLoadAncestors': return 'rest/ngrestloadancestors';
		case 'NGRestMoveObject': return 'rest/ngrestmoveobject';
		case 'NGRestGetFileState': return 'rest/ngrestgetfilestate';
		case 'NGRestLoadLanguage': return 'rest/ngrestloadlanguage';
		case 'NGRestSaveLanguage': return 'rest/ngrestsavelanguage';
		case 'NGRestGetObjectChangesCount': return 'rest/ngrestgetobjectchangescount';
		case 'NGRestGetLastObjectChangeUID': return 'rest/ngrestgetlastobjectchangeuid';
		case 'NGRestPluginCallback': return 'rest/ngrestplugincallback';
		case 'NGRestCountObjects': return 'rest/ngrestcountobjects';
		case 'NGRestInstall': return 'rest/ngrestinstall';
		case 'NGRestReadMeta': return 'rest/ngrestreadmeta';
		case 'NGRestWriteMeta': return 'rest/ngrestwritemeta';
		case 'NGRestClearCache': return 'rest/ngrestclearcache';
        case 'NGRestGetURL': return 'rest/ngrestgeturl';
		case 'NGInstall': return 'install/nginstall';
		case 'NGException': return 'exception/ngexception';
		case 'NGIllegalCredentialsException': return 'exception/ngillegalcredentialsexception';
		case 'NGDuplicateValueException': return 'exception/ngduplicatevalueexception';
		case 'NGNotLoggedInException': return 'exception/ngnotloggedinexception';
		case 'NGAlreadyLoggedInException': return 'exception/ngalreadyloggedinexception';
		case 'NGAccessDeniedException': return 'exception/ngaccessdeniedexception';
		case 'NGDatabaseException': return 'exception/ngdatabaseexception';
        case 'NGDatabaseDuplicateKeyException': return 'exception/ngdatabaseduplicatekeyexception';
		case 'NGNotFoundException': return 'exception/ngnotfoundexception';
		case 'NGInTrashException': return 'exception/ngintrashexception';
		case 'NGRecursionException': return 'exception/ngrecursionexception';
		case 'NGMissingPostException': return 'exception/ngmissingpostexception';
		case 'Smarty': return 'smarty.3.1.33/smarty.class';
		case 'NGPageCache': return 'cache/ngpagecache';
		case 'NGURLCache': return 'cache/ngurlcache';
		case 'NGFTS': return 'fts/ngfts';
		case 'NGSettingsTabs': return 'model/simple/ngsettingstabs';
        case 'NGSettingsFAQ': return 'model/simple/ngsettingsfaq';
		case 'NGSettingsSite': return 'model/simple/ngsettingssite';
		case 'NGSettingsLayoutStyle': return 'model/simple/ngsettingslayoutstyle';
		case 'NGSettingsStandardPages': return 'model/simple/ngsettingsstandardpages';
		case 'NGSettingsStandardTopics': return 'model/simple/ngsettingsstandardtopics';
		case 'NGSettingsAccordion': return 'model/simple/ngsettingsaccordion';
		case 'NGSettingsColumns': return 'model/simple/ngsettingscolumns';
		case 'NGLanguageAdapter': return 'language/nglanguageadapter';
		case 'NGLanguageResource': return 'language/nglanguageresource';
		case 'NGSettingsLanguage': return 'language/ngsettingslanguage';
		case 'NGMime': return 'util/ngmime';
        case 'NGPluginIcon': return 'plugins/ngpluginicon/ngpluginicon';
        case 'NGPluginErrorPage': return 'plugins/ngpluginerrorpage/ngpluginerrorpage';
        case 'NGAdvancedPropertyDefinitionCategories': return 'model/simple/ngadvancedpropertydefinitioncategories';
        case 'NGAdvancedPropertyDefinitionCategory': return 'model/simple/ngadvancedpropertydefinitioncategory';
        case 'NGAdvancedPropertyDefinition': return 'model/simple/ngadvancedpropertydefinition';
        case 'NGModuleNotConfiguredException': return 'exception/ngmodulenotconfiguredexception';

		default: return '';
	}
}

/**
 *
 * Automagically loads class
 * @param string $class Name of class to load
 */
function ngautoload($class)
{

    $filename = NGAutoloadFilename($class);

    if ($filename === '') {
        if (NGConfig::IsShop) {
            NGIncludeClass('plugins/ngpluginshop/ngshopincludes');
            $filename = NGShopIncludes::NGAutoloadFilename($class);
        }
    }

    NGIncludeClass($filename);
}

/**
 *
 * Includes a class, specify filename without PHP and folder without trailing /
 * @param string $filename Filename to include
 */
function NGIncludeClass($filename)
{
    if ($filename !== '') {
        $filenameWithPath = NGClassFolder() . $filename . '.php';
        if (file_exists($filenameWithPath)) {
            include_once($filenameWithPath);
        }
    }
}

/**
 *
 * Finds position of folder "classes"
 */
function NGClassFolder()
{
    $classFolder = str_replace('\\', '/', dirname(__FILE__));
    if (substr($classFolder, -1) != '/') $classFolder .= '/';

    return $classFolder;
}

NGIncludeClass('config/ngconfig');
spl_autoload_register('ngautoload');