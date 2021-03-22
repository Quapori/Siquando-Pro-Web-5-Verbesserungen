<?php

class NGInstall
{

    private $lang;

    const LevelNone = 0;
    const LevelRootOnly = 1;
    const LevelBasicPages = 2;

    const FileLang = 'install.lang';
    const FileSchema = '../../xml/dbschema.xml';
    const FileSchemaShop = '../plugins/ngpluginshop/xml/dbschema.xml';

    const VersionNone = '0.0';

    private function getFilename($filename)
    {
        $workFolder = dirname(__FILE__);
        return NGUtil::joinPaths($workFolder, $filename);
    }

    public function __construct()
    {
        $this->lang = parse_ini_file($this->getFilename(self::FileLang));
    }

    /**
     *
     * Grants for full access by one user or group
     * @param string $userOrGroup
     */
    private function fullAccess($userOrGroup)
    {
        return array(NGObject::ActionView => array($userOrGroup => NGObject::AccessAny), NGObject::ActionAdd => array($userOrGroup => NGObject::AccessAny), NGObject::ActionModify => array($userOrGroup => NGObject::AccessAny), NGObject::ActionDelete => array($userOrGroup => NGObject::AccessAny), NGObject::ActionAdmin => array($userOrGroup => NGObject::AccessAny));
    }

    /**
     *
     * Grants for protected access by one user or group
     * @param string $userOrGroup
     */
    private function protectedAccess($userOrGroup)
    {
        return array(NGObject::ActionView => array($userOrGroup => NGObject::AccessAny), NGObject::ActionAdd => array($userOrGroup => NGObject::AccessAny), NGObject::ActionModify => array($userOrGroup => NGObject::AccessAny), NGObject::ActionDelete => array($userOrGroup => NGObject::AccessAny), NGObject::ActionAdmin => array());
    }

    /**
     *
     * Default grants
     * @param string $adminGroup
     * @param string $userGroup
     */
    private function mixedAccess($adminGroup, $userGroup)
    {
        return array(NGObject::ActionView => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessAny), NGObject::ActionAdd => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessAny), NGObject::ActionModify => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessAny), NGObject::ActionDelete => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessAny), NGObject::ActionAdmin => array($adminGroup => NGObject::AccessAny));
    }

    /**
     *
     * Default grants
     * @param string $adminGroup
     * @param string $userGroup
     */
    private function trashAccess($adminGroup, $userGroup)
    {
        return array(NGObject::ActionView => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessAny), NGObject::ActionAdd => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessAny), NGObject::ActionModify => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessOwner), NGObject::ActionDelete => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessOwner), NGObject::ActionAdmin => array($adminGroup => NGObject::AccessAny, $userGroup => NGObject::AccessOwner));
    }

    /**
     *
     * Install Tables and basic objects
     */
    public function install($installLevel, $forceInstall)
    {
        $didInstall = false;

        NGDBConnector::getInstance()->connect();
        NGSession::getInstance()->user = NGUser::getUserSystem();

        $version = $forceInstall ? self::VersionNone : $this->readDatabaseVersion();

        if ($version < NGConfig::DatabaseVersion) {

            NGUtil::emptyFolder(NGConfig::storePath());

            $didInstall = true;

            $this->installSchema(self::FileSchema, $version);

            if ($installLevel >= self::LevelRootOnly && $version===self::VersionNone) {
                $this->installRoot($installLevel);
                $this->installUsers();
                $this->writeSiteID();
            }

            $this->writeDatabaseVersion();
        } else {
            $pageCache = new NGPageCache();
            $pageCache->clear();
            $urlCache = new NGURLCache();
            $urlCache->clear();
        }

        if (NGConfig::IsShop) {
            if (file_exists($this->getFilename(self::FileSchemaShop))) {
                $shopversion = $forceInstall ? self::VersionNone : $this->readShopDatabaseVersion();

                if ($shopversion < NGConfig::ShopDatabaseVersion) {
                    $this->installSchema(self::FileSchemaShop, $shopversion);
                    $this->writeShopDatabaseVersion();
                    $this->deleteShopSessions();
                }

                if ($installLevel >= self::LevelRootOnly) {
                    $this->installSpecialRootsShop($installLevel);
                }
            }
        }

        NGDBConnector::getInstance()->disconnect();

        return $didInstall;
    }

    /**
     *
     * Write site metadata
     * @param string $siteId
     */
    private function writeSiteID()
    {
        $siteId = NGUtil::createUID();
        $meta = new NGDBAdapterObject ();
        $meta->writeMeta(NGUtil::MetaSiteId, $siteId);
    }

    private function deleteShopSessions()
    {
        $delete = new NGDBAdapterObject();
        $query = new NGDBQueryDelete();
        $query->table='shop_session';
        $query->executeQuery();

    }

    /**
     *
     * Write the database version
     */
    private function writeDatabaseVersion()
    {
        $meta = new NGDBAdapterObject ();
        $meta->writeMeta(NGUtil::MetaDatabaseVersion, NGConfig::DatabaseVersion);
    }

    /**
     *
     * Write the shop database version
     */
    private function writeShopDatabaseVersion()
    {
        $meta = new NGDBAdapterObject ();
        $meta->writeMeta(NGUtil::MetaShopDatabaseVersion, NGConfig::ShopDatabaseVersion);
    }


    private function readDatabaseVersion()
    {
        try {
            $meta = new NGDBAdapterObject ();
            return $meta->readMeta(NGUtil::MetaDatabaseVersion, self::VersionNone);
        } catch (NGDatabaseException $ex) {
            return self::VersionNone;
        }
    }

    private function readShopDatabaseVersion()
    {
        try {
            $meta = new NGDBAdapterObject ();
            return $meta->readMeta(NGUtil::MetaShopDatabaseVersion, self::VersionNone);
        } catch (NGDatabaseException $ex) {
            return self::VersionNone;
        }
    }


    /**
     *
     * Install table schema
     */
    private function installSchema($filename, $version)
    {
        $domDocument = new DOMDocument ('1.0', 'UTF-8');

        $domDocument->load($this->getFilename($filename));

        $adapterSchema = new NGDBAdapterSchema ();

        /* @var $schema NGDBSchemaSchema */
        $schema = $adapterSchema->loadSchema($domDocument->documentElement);

        $schema->createSchema($version);
    }

    /**
     *
     * Install a special sub root
     * @param string $class ClassName for root
     * @param string $objectUID UID for root
     */
    private function installSpecialRoot($caption, $name, $objectUID, $subFolderClass, $parentUID = NGUtil::ObjectUIDRoot)
    {
        $adapterObject = new NGDBAdapterObject ();

        $existingObject = $adapterObject->loadObject($objectUID);

        if ($existingObject === null) {
            $root = new NGFolder ();
            $root->caption = $caption;
            $root->name = $name;
            $root->objectUID = $objectUID;
            $root->parentUID = $parentUID;
            $root->subFolderClass = $subFolderClass;
            $root->grants = $this->mixedAccess(NGUtil::ObjectUIDAdminGroup, NGUtil::ObjectUIDUsersGroup);
            $adapterObject->saveObject($root, $this->lang ['annotation'], true, true, true);
        }
    }

    private function installSpecialTopic($name, $caption, $objectUID, $subFolderClass, $parentUID, $templateUID = NGUtil::ObjectUIDInherit)
    {
        $adapterObject = new NGDBAdapterObject ();

        $existingObject = $adapterObject->loadObject($objectUID);

        if ($existingObject === null) {
            $root = new NGTopic ();
            $root->name = $name;
            $root->caption = $caption;
            $root->objectUID = $objectUID;
            $root->parentUID = $parentUID;
            $root->subFolderClass = $subFolderClass;
            $root->templateUID = $templateUID;
            $root->grants = $this->mixedAccess(NGUtil::ObjectUIDAdminGroup, NGUtil::ObjectUIDUsersGroup);
            $adapterObject->saveObject($root, $this->lang ['annotation'], true, true, true);
        }
    }

    /**
     *
     * Install a protected sub root
     * @param string $class ClassName for root
     * @param string $objectUID UID for root
     */
    private function installProtectedRoot($name, $objectUID)
    {
        $adapterObject = new NGDBAdapterObject ();

        $existingObject = $adapterObject->loadObject($objectUID);

        if ($existingObject === null) {
            $root = new NGFolder ();
            $root->name = $name;
            $root->objectUID = $objectUID;
            $root->parentUID = NGUtil::ObjectUIDRoot;
            $root->grants = $this->protectedAccess(NGUtil::ObjectUIDAdminGroup);
            $adapterObject->saveObject($root, $this->lang ['annotation'], true, true);
        }
    }

    /**
     *
     * Install a trash sub root
     * @param string $class ClassName for root
     * @param string $objectUID UID for root
     */
    private function installTrashRoot($name, $objectUID)
    {
        $adapterObject = new NGDBAdapterObject ();

        $root = new NGFolder ();
        $root->name = $name;
        $root->objectUID = $objectUID;
        $root->parentUID = NGUtil::ObjectUIDRoot;
        $root->grants = $this->trashAccess(NGUtil::ObjectUIDAdminGroup, NGUtil::ObjectUIDUsersGroup);
        $adapterObject->saveObject($root, $this->lang ['annotation'], true, true);
    }

    /**
     *
     * Installs all special roots
     */
    private function installSpecialRoots($installLevel)
    {
        $this->installProtectedRoot($this->lang ['rootusersandgroups'], NGUtil::ObjectUIDRootUsersAndGroups);
        $this->installProtectedRoot($this->lang ['rootsettings'], NGUtil::ObjectUIDRootSettings);
        $this->installSpecialRoot($this->lang ['rootpictures'], 'pictures', NGUtil::ObjectUIDRootPictures, NGFolder::ObjectTypeFolder);
        $this->installSpecialRoot($this->lang ['rootcontent'], 'content', NGUtil::ObjectUIDRootContent, NGTopic::ObjectTypeTopic);
        $this->installSpecialRoot($this->lang ['rootdownloads'], 'downloads', NGUtil::ObjectUIDRootAssets, NGFolder::ObjectTypeFolder);
        $this->installSpecialRoot($this->lang ['rootlayoutpictures'], 'layoutpictures', NGUtil::ObjectUIDRootLayoutPictures, NGFolder::ObjectTypeFolder, NGUtil::ObjectUIDRootPictures);
        $this->installSpecialTopic('home', $this->lang ['topichome'], NGUtil::ObjectUIDRootHome, NGTopic::ObjectTypeTopic, NGUtil::ObjectUIDRootContent, NGUtil::ObjectUIDTemplatePageA);
        $this->installSpecialTopic('common', $this->lang ['topiccommon'], NGUtil::ObjectUIDRootCommon, NGTopic::ObjectTypeTopic, NGUtil::ObjectUIDRootContent);
        $this->installSpecialTopic('templates', $this->lang ['topictemplates'], NGUtil::ObjectUIDRootTemplates, NGTopic::ObjectTypeTopic, NGUtil::ObjectUIDRootCommon);
        $this->installSpecialTopic('special', $this->lang ['topicspecial'], NGUtil::ObjectUIDRootSpecial, NGTopic::ObjectTypeTopic, NGUtil::ObjectUIDRootCommon);
        $this->installSpecialTopic('info', $this->lang ['topicinfo'], NGUtil::ObjectUIDRootInfo, NGTopic::ObjectTypeTopic, NGUtil::ObjectUIDRootCommon);

        if ($installLevel >= self::LevelBasicPages) {
            $this->installPage($this->lang ['pagetemplateb'], NGUtil::ObjectUIDTemplatePageB, NGUtil::ObjectUIDRootTemplates, 'templateb.html');
            $this->installPage($this->lang ['pagetemplatea'], NGUtil::ObjectUIDTemplatePageA, NGUtil::ObjectUIDRootTemplates, 'templatea.html');
            $this->installPage($this->lang ['pagehomepage'], NGUtil::ObjectUIDHomePage, NGUtil::ObjectUIDRootHome, 'index.html', 'sidebarleft,sidebarright');
            $this->installSearchPage();
            $this->installLoginPage();
        }

        $this->installSettings();

        $this->installTrashRoot($this->lang ['foldertrash'], NGUtil::ObjectUIDRootTrash, false);
    }

    private function installSpecialRootsShop($installLevel)
    {
        $this->installSpecialRoot($this->lang ['rootproducts'], 'products', NGUtil::ObjectUIDRootProducts, NGFolder::ObjectTypeFolder);
    }

    private function installSettings()
    {
        $adapterObject = new NGDBAdapterObject ();
        $pages = new NGSettingsStandardPages ();
        $pages->pageuids ['search'] = NGUtil::ObjectUIDSearchPage;
        $pages->pageuids ['login'] = NGUtil::ObjectUIDLoginPage;
        $adapterObject->saveObject($pages, $this->lang ['annotation'], true, true, true);

        $topics = new NGSettingsStandardTopics();
        $topics->topicuids ['common'] = NGUtil::ObjectUIDRootInfo;
        $adapterObject->saveObject($topics, $this->lang ['annotation'], true, true, true);

    }

    private function installSearchPage()
    {
        $adapterObject = new NGDBAdapterObject ();

        $streams = $this->installPage($this->lang ['pagesearch'], NGUtil::ObjectUIDSearchPage, NGUtil::ObjectUIDRootSpecial, 'search.html', 'sidebarleft,sidebarright');
        $paragraph = new NGPluginParagraph ();
        $paragraph->pluginName = 'NGPluginParagraphSearch';
        $paragraph->parentUID = $streams [NGParagraphStream::ParagraphStreamContent]->objectUID;

        $adapterObject->saveObject($paragraph, $this->lang ['annotation'], true, true);
    }

    private function installLoginPage()
    {
        $adapterObject = new NGDBAdapterObject ();

        $streams = $this->installPage($this->lang ['pagelogin'], NGUtil::ObjectUIDLoginPage, NGUtil::ObjectUIDRootSpecial, 'login.html', 'sidebarleft,sidebarright');
        $paragraph = new NGPluginParagraph ();
        $paragraph->pluginName = 'NGPluginParagraphLogin';
        $paragraph->parentUID = $streams [NGParagraphStream::ParagraphStreamContent]->objectUID;

        $adapterObject->saveObject($paragraph, $this->lang ['annotation'], true, true);
    }


    /**
     *
     * Creates the homepage
     * @param string $caption Caption of homepage
     */
    private function installPage($caption, $objectUID, $parentUID, $filename = 'index.html', $hiddenparagraphstreams = '')
    {
        $adapterObject = new NGDBAdapterObject ();

        $page = new NGPluginPage ();
        $page->caption = $caption;
        $page->name = $filename;
        $page->pluginName = 'NGPluginPageDefault';
        $page->parentUID = $parentUID;
        $page->objectUID = $objectUID;
        $page->hiddenParagraphStreams = $hiddenparagraphstreams;

        $adapterObject->saveObject($page, $this->lang ['annotation'], true, true);

        return $this->createAllParagraphStreams($objectUID);

    }

    private function createAllParagraphStreams($parentUID)
    {
        $paragraphStreams = Array();

        $paragraphStreams [NGParagraphStream::ParagraphStreamHeader] = $this->createParagraphStream(NGParagraphStream::ParagraphStreamHeader, $parentUID);
        $paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft] = $this->createParagraphStream(NGParagraphStream::ParagraphStreamSidebarLeft, $parentUID);
        $paragraphStreams [NGParagraphStream::ParagraphStreamContent] = $this->createParagraphStream(NGParagraphStream::ParagraphStreamContent, $parentUID);
        $paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight] = $this->createParagraphStream(NGParagraphStream::ParagraphStreamSidebarRight, $parentUID);
        $paragraphStreams [NGParagraphStream::ParagraphStreamFooter] = $this->createParagraphStream(NGParagraphStream::ParagraphStreamFooter, $parentUID);

        return $paragraphStreams;
    }

    private function createParagraphStream($name, $parentUID)
    {
        $adapterObject = new NGDBAdapterObject ();

        $paragraphStream = new NGParagraphStream ();
        $paragraphStream->name = $name;
        $paragraphStream->caption = $this->lang [$name];
        $paragraphStream->parentUID = $parentUID;

        $adapterObject->saveObject($paragraphStream, $this->lang ['annotation'], true, true);

        return $paragraphStream;
    }

    /**
     *
     * Installs root
     */
    private function installRoot($installLevel)
    {
        $adapterObject = new NGDBAdapterObject ();

        $root = new NGFolder ();
        $root->objectUID = NGUtil::ObjectUIDRoot;
        $root->name = '{Root}';
        $root->grants = array(NGObject::ActionView => array(NGUtil::ObjectUIDSystem => NGObject::AccessAny, NGUtil::ObjectUIDAdminGroup => NGObject::AccessAny, NGUtil::ObjectUIDUsersGroup => NGObject::AccessAny), NGObject::ActionAdd => array(NGUtil::ObjectUIDSystem => NGObject::AccessAny), NGObject::ActionModify => array(NGUtil::ObjectUIDSystem => NGObject::AccessAny), NGObject::ActionDelete => array(NGUtil::ObjectUIDSystem => NGObject::AccessAny), NGObject::ActionAdmin => array(NGUtil::ObjectUIDSystem => NGObject::AccessAny));

        $adapterObject->saveObject($root, $this->lang ['annotation'], true, true);

        $this->installSpecialRoots($installLevel);
    }

    /**
     *
     * Installs users
     */
    private function installUsers()
    {
        $adapterObject = new NGDBAdapterObject ();

        $systemGroup = new NGGroup ();
        $systemGroup->name = $this->lang ['groupsystem'];
        $systemGroup->objectUID = NGUtil::ObjectUIDSystemGroup;
        $systemGroup->parentUID = NGUtil::ObjectUIDRootUsersAndGroups;
        $systemGroup->grants = array(NGObject::ActionModify => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny), NGObject::ActionDelete => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny));
        $adapterObject->saveObject($systemGroup, $this->lang ['annotation'], false, true);

        $systemUser = new NGUser ();
        $systemUser->name = $this->lang ['usersystem'];
        $systemUser->objectUID = NGUtil::ObjectUIDSystem;
        $systemUser->parentUID = NGUtil::ObjectUIDRootUsersAndGroups;
        $systemUser->enabled = false;
        $systemUser->groups = array(NGUtil::ObjectUIDSystemGroup);
        $systemUser->maingroup = NGUtil::ObjectUIDSystemGroup;
        $systemUser->grants = array(NGObject::ActionModify => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny), NGObject::ActionDelete => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny));
        $adapterObject->saveObject($systemUser, $this->lang ['annotation'], false, true);

        $adminGroup = new NGGroup ();
        $adminGroup->name = $this->lang ['groupadmin'];
        $adminGroup->objectUID = NGUtil::ObjectUIDAdminGroup;
        $adminGroup->parentUID = NGUtil::ObjectUIDRootUsersAndGroups;
        $adminGroup->grants = array(NGObject::ActionModify => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny), NGObject::ActionDelete => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny));
        $adapterObject->saveObject($adminGroup, $this->lang ['annotation'], false, true);

        $adminUser = new NGUser ();
        $adminUser->name = $this->lang ['useradmin'];
        $adminUser->objectUID = NGUtil::ObjectUIDAdmin;
        $adminUser->parentUID = NGUtil::ObjectUIDRootUsersAndGroups;
        $adminUser->groups = array(NGUtil::ObjectUIDAdminGroup);
        $adminUser->maingroup = NGUtil::ObjectUIDAdminGroup;
        $adminUser->login = 'admin';
        $adminUser->password = NGConfig::AdminPassword;
        $adminUser->grants = array(NGObject::ActionDelete => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny));
        $adapterObject->saveObject($adminUser, $this->lang ['annotation'], false, true);

        $userGroup = new NGGroup ();
        $userGroup->name = $this->lang ['groupuser'];
        $userGroup->objectUID = NGUtil::ObjectUIDUsersGroup;
        $userGroup->parentUID = NGUtil::ObjectUIDRootUsersAndGroups;
        $userGroup->grants = array(NGObject::ActionModify => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny), NGObject::ActionDelete => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessDeny));
        $adapterObject->saveObject($userGroup, $this->lang ['annotation'], false, true);

        $userUser = new NGUser ();
        $userUser->name = $this->lang ['useruser'];
        $userUser->objectUID = NGUtil::ObjectUIDUser;
        $userUser->parentUID = NGUtil::ObjectUIDRootUsersAndGroups;
        $userUser->groups = array(NGUtil::ObjectUIDUsersGroup);
        $userUser->maingroup = NGUtil::ObjectUIDUsersGroup;
        $userUser->login = 'user';
        $userUser->password = NGConfig::UserPassword;
        $userUser->enabled = (NGConfig::UserPassword !== '');
        $adapterObject->saveObject($userUser, $this->lang ['annotation']);
    }
}