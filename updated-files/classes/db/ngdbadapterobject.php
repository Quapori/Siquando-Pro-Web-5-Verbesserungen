<?php

/**
 *
 * This class stores and retrieves objects and object changes to/from the database
 *
 *
 */
class NGDBAdapterObject
{
    const TableObject = 'object';
    const TableObjectChange = 'object_change';
    const TableProperty = 'property';
    const TablePropertyChange = 'property_change';
    const TableGrant = 'grant';
    const TableGrantChange = 'grant_change';
    const TableMeta = 'meta';

    const ColumnObjectUID = 'object_uid';
    const ColumnDomain = 'domain';
    const ColumnLang = 'lang';
    const ColumnName = 'name';
    const ColumnIndex = 'index';
    const ColumnRevisionUID = 'revision_uid';
    const ColumnClass = 'class';
    const ColumnOwner = 'owner';
    const ColumnOwnerGroup = 'owner_group';
    const ColumnChangeDate = 'change_date';
    const ColumnCreationDate = 'creation_date';
    const ColumnChangeOwner = 'change_owner';
    const ColumnValueInt = 'value_int';
    const ColumnValueFloat = 'value_float';
    const ColumnValueString = 'value_string';
    const ColumnValueText = 'value_text';
    const ColumnValueFulltext = 'value_fulltext';
    const ColumnChangeUID = 'change_uid';
    const ColumnChangeType = 'change_type';
    const ColumnAnnotation = 'annotation';
    const ColumnInstallationId = 'installation_id';
    const ColumnType = 'type';
    const ColumnParentUID = 'parent_uid';
    const ColumnAction = 'action';
    const ColumnAccess = 'access';
    const ColumnUnique = 'unique';
    const ColumnID = 'id';
    const ColumnValue = 'value';

    const AliasObject = 'o';
    const AliasProperty = 'p';
    const AliasResult = 'r';
    const AliasLanguage = 'l';
    const AliasIndex = 'i';
    const AliasRevisionUID = 'v';
    const AliasAncestorUID = 'a';

    const CollisionName = 'name';
    const CollisionDomain = 'domain';
    const CollisionValue = 'value';
    const CollisionObjectUID = 'objectuid';
    const CollisionAlternative = 'alternative';

    const FunctionCount = 'count';
    const FunctionMax = 'max';

    const PrefixPluginClass = 'NGPlugin';

    /**
     *
     * Filters changes by domain, defaults to 'core'
     * @var array
     */
    public $domains = array();

    /**
     *
     * Filters changes by language, defaults to NGConfig::LanguageNeutral and NGUtil::LanguageDefault
     * @var array
     */
    public $langs = array(NGUtil::LanguageNeutral, NGUtil::LanguageDefault);

    /**
     *
     * Object change
     * @var NGObjectChange
     */
    private $objectChange;

    /**
     *
     * Array that maps NGPropertyTypes to columns
     * @var array
     */
    private $propertyColumns = array(NGProperty::TypeString => self::ColumnValueString, NGProperty::TypeInt => self::ColumnValueInt, NGProperty::TypeFloat => self::ColumnValueFloat, NGProperty::TypeBool => self::ColumnValueInt, NGProperty::TypeDateTime => self::ColumnValueString, NGProperty::TypeText => self::ColumnValueText, NGProperty::TypeFulltext => self::ColumnValueFulltext, NGProperty::TypeUID => self::ColumnValueString, NGProperty::TypeFile => self::ColumnValueString);

    /**
     *
     * Array that maps NGPropertyTypes to NgDbQueryCriteriaTypes
     * @var array
     */
    private $propertyTypes = array(NGProperty::TypeString => NGDBQPartCriteria::TypeString, NGProperty::TypeInt => NGDBQPartCriteria::TypeNumeric, NGProperty::TypeFloat => NGDBQPartCriteria::TypeNumeric, NGProperty::TypeBool => NGDBQPartCriteria::TypeBoolean, NGProperty::TypeDateTime => NGDBQPartCriteria::TypeString, NGProperty::TypeText => NGDBQPartCriteria::TypeString, NGProperty::TypeFulltext => NGDBQPartCriteria::TypeString, NGProperty::TypeUID => NGDBQPartCriteria::TypeString, NGProperty::TypeFile => NGDBQPartCriteria::TypeString);

    /**
     *
     * Loads all children objects
     * @param string $parentUID
     * @param string $classFilter
     * @param string $className
     * @param string $revisionUID
     * @param bool $loadProperties
     * @param bool $loadGrants
     * @param bool $loadPermissions
     */
    public function loadChildObjects($parentUID, $classFilter = null, $className = NGObject::ObjectTypeObject, $revisionUID = '', $loadProperties = true, $loadGrants = true, $loadPermissions = true, $allowTrashedObjects = false, $sortByCaption = false, $sortDesc = false)
    {
        $objects = array();

        $parentGrantsForUser = null;

        if ($loadPermissions) {
            $parentObject = $this->loadObject($parentUID, null, NGObject::ObjectTypeObject, $revisionUID, false, true, false, $allowTrashedObjects);

            if ($parentObject === null && $revisionUID !== '') {
                /* when loading revision, try to load parent without revision */
                $parentObject = $this->loadObject($parentUID, null, NGObject::ObjectTypeObject, '', false, true, false, $allowTrashedObjects);
            }

            if ($parentObject === null) {
                throw new NGNotFoundException ($parentUID);
            }

            $parentGrantsForUser = $this->getGrantsForUser($parentObject, NGSession::getInstance()->user, null, $allowTrashedObjects);
        }

        $query = new NGDBQuerySelect ();
        $query->table = new NGDBQPartTableAs (self::TableObject, self::AliasObject);
        $query->colums = array(self::ColumnClass, self::ColumnOwnerGroup, self::ColumnOwner, self::ColumnChangeDate, self::ColumnCreationDate, new NGDBQPartAliasColumn (self::AliasObject, self::ColumnRevisionUID), self::ColumnParentUID, new NGDBQPartAliasColumn (self::AliasObject, self::ColumnObjectUID));
        $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnParentUID, $parentUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

        if ($classFilter !== null) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnClass, $classFilter, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        if ($revisionUID !== null) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnRevisionUID), $revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        if ($sortByCaption) {
            $query->joins [] = new NGDBQPartJoin (new NGDBQPartTableAs (self::TableProperty, self::AliasProperty), Array(new NGDBQPartOn (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnObjectUID), new NGDBQPartAliasColumn (self::AliasProperty, self::ColumnObjectUID)), new NGDBQPartOn (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnRevisionUID), new NGDBQPartAliasColumn (self::AliasProperty, self::ColumnRevisionUID))));
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnName, 'caption', NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
            $query->orderColumns [] = new NGDBQPartOrderColumn (self::ColumnValueString, $sortDesc);
        } else {
            $query->orderColumns [] = new NGDBQPartOrderColumn (self::ColumnCreationDate, $sortDesc);
        }

        $result = $query->executeQuery();
        /* @var $result mysqli_result */

        $row = $result->fetch_assoc();

        while ($row) {
            $object = $this->loadObjectFromRow($row, $className, $loadProperties);

            if ($loadGrants || $loadPermissions) {
                $this->loadGrants($object);
            }
            if ($loadPermissions) {
                $this->loadPermissions($object, NGSession::getInstance()->user, $parentGrantsForUser, ($parentUID === NGUtil::ObjectUIDRootTrash));
            }

            $objects [] = $object;

            $row = $result->fetch_assoc();
        }

        return $objects;
    }

    /**
     * Counts objects
     * @param string $classFilter Class of object
     * @return int Count of objects
     */
    public function countObjects($classFilter = '')
    {
        $query = new NGDBQuerySelect ();
        $query->table = self::TableObject;
        $query->colums = array(new NGDBQPartFunctionAs (self::FunctionCount, self::ColumnObjectUID, self::FunctionCount));

        if ($classFilter !== null) {
            $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnClass, $classFilter, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        }

        $result = $query->executeQuery();

        $row = $result->fetch_row();

        return $row [0];
    }

    /**
     * Fetches an object from the database
     * @param string $objectUID UID of object to be fetched from database
     * @param string $className Classname of the object to be created
     * @param string $revisionUID Revision to load
     * @return NGObject restored object
     */
    public function loadObject($objectUID, $classFilter = null, $className = NGObject::ObjectTypeObject, $revisionUID = '', $loadProperties = true, $loadGrants = true, $loadPermissions = true, $allowTrashedObjects = false)
    {

        $object = NULL;

        $this->langs = array(NGUtil::LanguageNeutral, NGUtil::LanguageDefault);

        try {
            $query = new NGDBQuerySelect ();
            $query->table = self::TableObject;
            $query->colums = array(self::ColumnObjectUID, self::ColumnClass, self::ColumnOwnerGroup, self::ColumnOwner, self::ColumnChangeDate, self::ColumnCreationDate, self::ColumnRevisionUID, self::ColumnParentUID);
            $query->whereCriterias = array();
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

            if ($classFilter !== null) {
                $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnClass, $classFilter, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
            }

            if ($revisionUID !== null) {
                $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
            }

            $result = $query->executeQuery();
            /* @var $result mysqli_result */

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $object = $this->loadObjectFromRow($row, $className, $loadProperties, $loadGrants, $loadPermissions);

                if ($loadGrants || $loadPermissions) {
                    $this->loadGrants($object);
                }
                if ($loadPermissions) {
                    $this->loadPermissions($object, NGSession::getInstance()->user, null, $allowTrashedObjects);
                    $this->assertAccess(NGUser::ActionView, $object);
                }
            }
            $result->close();
        } catch (NGInTrashException $ex) {
            return null;
        }

        return $object;
    }

    /**
     *
     * Loads an object from a database row
     * @param array $row
     * @param string $className
     * @param bool $loadProperties
     * @param bool $loadGrants
     * @param bool $loadPermissions
     */
    private function loadObjectFromRow($row, $className, $loadProperties)
    {
        /* @var $object NGObjectMapped */

        $object = new $className ();

        $object->objectUID = $row [self::ColumnObjectUID];
        $object->class = $row [self::ColumnClass];
        $object->owner = $row [self::ColumnOwner];
        $object->ownerGroup = $row [self::ColumnOwnerGroup];
        $object->changeDate = $row [self::ColumnChangeDate];
        $object->creationDate = $row [self::ColumnCreationDate];
        $object->revisionUID = $row [self::ColumnRevisionUID];
        $object->parentUID = $row [self::ColumnParentUID];

        if ($object instanceof NGObjectMapped) {
            if (!$this->isPlugin($object)) {
                $this->domains = $object->getDomainsMapped();
            } else {
                $this->domains = array();
            }
        }

        if ($loadProperties) {
            $this->loadProperties($object);

            if ($this->isPlugin($object)) {
                $object = $this->subClassPluginObject($object);
            }

            if ($object instanceof NGObjectMapped) {
                $object->loadPropertiesMapped();
            }
        }

        return $object;
    }

    /**
     *
     * Subclasses a plugin object
     * @param $object Object to subclass
     */
    private function subClassPluginObject($object)
    {

        $pluginSubClass = $this->findPropertyByName($object, 'pluginname')->value;
        $pluginSuperClass = $object->class;

        $folder = NGClassFolder();
        $includeFilename = $folder . 'plugins/' . strtolower($pluginSuperClass) . '/' . strtolower($pluginSubClass) . '/' . strtolower($pluginSubClass) . '.php';

        if (!file_exists($includeFilename)) {
            $pluginSubClass = $pluginSuperClass . 'Unknown';
            $includeFilename = $folder . 'plugins/' . strtolower($pluginSuperClass) . '/' . strtolower($pluginSubClass) . '.php';
        }
        require_once $includeFilename;

        if (!self::isCompatibleSubclass($pluginSubClass)) {
            $pluginSubClass = $pluginSuperClass . 'Obsolete';
            $includeFilename = $folder . 'plugins/' . strtolower($pluginSuperClass) . '/' . strtolower($pluginSubClass) . '.php';
        }
        require_once $includeFilename;

        $newObject = new $pluginSubClass ();

        $newObject->objectUID = $object->objectUID;
        $newObject->class = $object->class;
        $newObject->owner = $object->owner;
        $newObject->ownerGroup = $object->ownerGroup;
        $newObject->changeDate = $object->changeDate;
        $newObject->creationDate = $object->creationDate;
        $newObject->revisionUID = $object->revisionUID;
        $newObject->parentUID = $object->parentUID;
        $newObject->properties = $object->properties;

        return $newObject;
    }

    /**
     *
     * Checks, if a subclass is compatible with current product
     * @param string $className
     * @return boolean
     */
    public static function isCompatibleSubclass($className)
    {
        if (defined($className . '::Product')) {
            if (constant($className . '::Product') === NGConfig::Product) {
                return true;
            }
        }

        return false;
    }

    /**
     *
     * Finds a property
     * @param NGObjectNamed $object object to search
     * @param $name Name of property
     * @return NGProperty found property
     */
    private function findPropertyByName(NGObjectNamed $object, $name)
    {
        foreach ($object->properties as $property) {
            /* @var $property NGProperty */
            if ($property->name === $name)
                return $property;
        }

        return null;
    }

    /**
     *
     * Check if a object is a plugin
     * @param NGObjectMapped $object
     */
    private function isPlugin($object)
    {
        if ($object instanceof NGPluginPage)
            return true;
        if ($object instanceof NGPluginParagraph)
            return true;
        return false;
    }

    /**
     *
     * Loads changes to Object
     * @param string $objectUID UID of object
     * @param boolean $loadPropertyChanges also load property changes
     * @return array Array of NGObjectChange
     */
    public function loadObjectChanges($objectUID, $loadPropertyChanges, $loadGrantChanges, $revisionUID = null)
    {
        $query = new NGDBQuerySelect ();
        $query->table = self::TableObjectChange;
        $query->colums = array(self::ColumnChangeUID, self::ColumnChangeType, self::ColumnClass, self::ColumnOwner, self::ColumnOwnerGroup, self::ColumnChangeOwner, self::ColumnChangeDate, self::ColumnAnnotation, self::ColumnRevisionUID, self::ColumnParentUID);
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));

        if ($revisionUID !== null) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        $query->orderColumns = array(new NGDBQPartOrderColumn (self::ColumnChangeUID));

        $objectChanges = array();

        /* @var $result mysqli_result */
        $result = $query->executeQuery();

        $row = $result->fetch_assoc();

        while ($row) {
            $objectChange = new NGObjectChange ($row [self::ColumnChangeUID], $row [self::ColumnChangeType], $objectUID, $row [self::ColumnClass], $row [self::ColumnOwner], $row [self::ColumnChangeDate], $row [self::ColumnAnnotation], $row [self::ColumnRevisionUID], $row [self::ColumnOwnerGroup], $row [self::ColumnChangeOwner], $row [self::ColumnParentUID]);

            if ($loadPropertyChanges) {
                $this->loadPropertyChanges($objectChange);
            }
            if ($loadGrantChanges) {
                $this->loadGrantChanges($objectChange);
            }

            $objectChanges [$objectChange->changeUID] = $objectChange;

            $row = $result->fetch_assoc();
        }
        $result->close();

        return $objectChanges;
    }

    /**
     *
     * Loads an objectchange
     * @param string $changeUID UID of change
     * @param boolean $loadPropertyChanges Should property changes also be loaded
     * @return NGObjectChange Objectchange or NULL if fail
     */
    public function loadObjectChange($changeUID, $loadPropertyChanges, $loadGrantChanges)
    {
        $objectChange = NULL;
        $query = new NGDBQuerySelect ();
        $query->table = self::TableObjectChange;

        $query->colums = array(self::ColumnObjectUID, self::ColumnChangeType, self::ColumnClass, self::ColumnOwner, self::ColumnOwnerGroup, self::ColumnChangeDate, self::ColumnChangeOwner, self::ColumnAnnotation, self::ColumnRevisionUID, self::ColumnParentUID);
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnChangeUID, $changeUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));

        $result = $query->executeQuery();
        /* @var $result mysqli_result */

        if ($result->num_rows == 0) {
            $result->close();

            return NULL;
        } else {
            $row = $result->fetch_assoc();

            /* @var $objectChange NGObjectChange */
            $objectChange = new NGObjectChange ($changeUID, $row [self::ColumnChangeType], $row [self::ColumnObjectUID], $row [self::ColumnClass], $row [self::ColumnOwner], $row [self::ColumnChangeDate], $row [self::ColumnAnnotation], $row [self::ColumnRevisionUID], $row [self::ColumnOwnerGroup], $row [self::ColumnChangeOwner], $row [self::ColumnParentUID]);

            $result->close();

            if ($loadPropertyChanges) {
                $this->loadPropertyChanges($objectChange);
            }
            if ($loadGrantChanges) {
                $this->loadGrantChanges($objectChange);
            }

            return $objectChange;
        }

    }

    /**
     *
     * Loads property changes
     * @param NGObjectChange $objectChange ObjectChange to load property changes
     */
    public function loadPropertyChanges(NGObjectChange $objectChange)
    {

        $query = new NGDBQuerySelect ();

        $query->table = self::TablePropertyChange;

        $query->colums = array(self::ColumnChangeType, self::ColumnDomain, self::ColumnLang, self::ColumnName, self::ColumnIndex, self::ColumnUnique, self::ColumnType, self::ColumnValueInt, self::ColumnValueFloat, self::ColumnValueString, self::ColumnValueText, self::ColumnValueFulltext);

        $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnChangeUID, $objectChange->changeUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

        if (count($this->domains) > 0) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnDomain, $this->domains, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        if (count($this->langs) > 0) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnLang, $this->langs, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        $result = $query->executeQuery();

        $objectChange->properties = array();

        $row = $result->fetch_assoc();

        while ($row) {
            $propertyChange = new NGPropertyChange ($row [self::ColumnChangeType], $row [self::ColumnName], $row [self::ColumnType], $row [$this->propertyColumns [$row [self::ColumnType]]], $row [self::ColumnLang], $row [self::ColumnDomain], $row [self::ColumnIndex], $row [self::ColumnUnique]);

            if ($propertyChange->type == NGProperty::TypeFile) {
                $propertyChange->fileState = $this->getFileState($objectChange->objectUID, $propertyChange->value);
            }

            $objectChange->properties [] = $propertyChange;

            $row = $result->fetch_assoc();
        }

        $result->close();
    }

    /**
     *
     * load grant changes
     * @param NGObjectChange $objectChange
     */
    public function loadGrantChanges(NGObjectChange $objectChange)
    {

        $query = new NGDBQuerySelect ();

        $query->table = self::TableGrantChange;

        $query->colums = array(self::ColumnAction, self::ColumnOwner, self::ColumnAccess, self::ColumnChangeType);

        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnChangeUID, $objectChange->changeUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));

        $result = $query->executeQuery();

        $objectChange->grants = array(NGObject::ActionView => array(), NGObject::ActionModify => array(), NGObject::ActionAdd => array(), NGObject::ActionDelete => array(), NGObject::ActionAdmin => array());

        $row = $result->fetch_assoc();

        while ($row) {
            $objectChange->grants [$row [self::ColumnAction]] [$row [self::ColumnOwner]] = new NGGrantChange ($row [self::ColumnChangeType], $row [self::ColumnAccess]);
            $row = $result->fetch_assoc();
        }

        $result->close();
    }

    /**
     *
     * Saves an object
     * @param $object NGObject
     * @param $annotation string
     * @return NGObjectChange
     */
    public function saveObject(NGObject $object, $annotation = '', $changeOwner = false, $saveGrants = false, $saveProperties = true, $allowTrashedObjects = false, $resolveCollisions = false, $saveChanges = true)
    {
        /* @var $object NGObject */
        $oldObject = NULL;

        if ($saveProperties) {
            if ($object instanceof NGObjectMapped) {
                $object->savePropertiesMapped();
            }

            if ($object instanceof NGObjectMapped) {
                $this->domains = $object->getDomainsMapped();
            }

            foreach ($object->properties as $property) {
                /* @var $property NGProperty */

                if (count($this->langs) > 0) {
                    if (!in_array($property->lang, $this->langs, true)) {
                        throw new Exception ('Property lang "' . $property->lang . '" is not in langs', 20000);
                    }
                }

                if (count($this->domains) > 0) {
                    if (!in_array($property->domain, $this->domains, true)) {
                        throw new Exception ('Property domain "' . $property->domain . '" is not in domains', 20000);
                    }
                }
            }

            $this->checkUniqueProperties($object, $resolveCollisions);
            $this->updateFiles($object);
        }

        $this->objectChange = new NGObjectChange (NGUtil::createUID(), NGObjectChange::ChangeTypeUpdate, $object->objectUID, $object->class, NGSession::getInstance()->user->objectUID, NGUtil::now(), $annotation, $object->revisionUID, NGSession::getInstance()->user->maingroup, NGSession::getInstance()->user->objectUID, $object->parentUID);

        if ($object->objectUID === '') {
            $object->objectUID = NGUtil::createUID();
            $this->objectChange->objectUID = $object->objectUID;
        } else {
            $oldObject = $this->loadObject($object->objectUID, null, NGObject::ObjectTypeObject, $object->revisionUID, true, true, true, $allowTrashedObjects);
        }

        if ($oldObject === NULL) {
            $object->owner = NGSession::getInstance()->user->objectUID;
            $object->ownerGroup = NGSession::getInstance()->user->maingroup;

            $this->loadPermissions($object, NGSession::getInstance()->user);

            $this->assertAccess(NGObject::ActionAdd, $object);
            if ($saveGrants) {
                $this->assertAccess(NGObject::ActionAdmin, $object);
            }

            $object->changeDate = $this->objectChange->changeDate;
            $object->creationDate = $this->objectChange->changeDate;

            $this->objectChange->changeType = NGObjectChange::ChangeTypeInsert;
            $this->insertObject($object);
            $oldObject = new NGObject ();
        } else {
            $this->assertAccess(NGObject::ActionModify, $oldObject);
            if ($saveGrants) {
                if ($object->parentUID !== NGUtil::ObjectUIDRootTrash) {
                    $this->assertAccess(NGObject::ActionAdmin, $oldObject);
                }
            }
            if ($changeOwner) {
                if ($object->parentUID !== NGUtil::ObjectUIDRootTrash) {
                    $this->assertAccess(NGObject::ActionAdmin, $oldObject);
                }
                if ($object->owner == '') {
                    $object->owner = NGSession::getInstance()->user->objectUID;
                }
                if ($object->ownerGroup == '') {
                    $object->ownerGroup = NGSession::getInstance()->user->maingroup;
                }
                $this->objectChange->owner = $object->owner;
                $this->objectChange->ownerGroup = $object->ownerGroup;
            } else {
                $this->objectChange->owner = $oldObject->owner;
                $this->objectChange->ownerGroup = $oldObject->ownerGroup;

                $object->owner = $oldObject->owner;
                $object->ownerGroup = $oldObject->ownerGroup;

                // $object->parentUID=$oldObject->parentUID;
            }
            $object->changeDate = $this->objectChange->changeDate;
            $this->updateObject($object);
        }

        if ($saveProperties) {
            $this->insertProperties($object, $oldObject);
            $this->updateProperties($object, $oldObject);
            $this->deleteProperties($object, $oldObject);

            foreach ($object->properties as $property) {
                if ($property->type === NGProperty::TypeFile) {
                    if (!$this->propertyExists($property, $this->objectChange->properties)) {
                        $this->objectChange->properties [] = new NGPropertyChange (NGPropertyChange::ChangeTypeUnchanged, $property->name, $property->type, $property->value, $property->lang, $property->domain, $property->index, $property->unique);
                    }
                }

            }

            foreach ($this->objectChange->properties as $propertyChange) {
                if ($propertyChange->type == NGProperty::TypeFile)
                    $propertyChange->fileState = $this->getFileState($object->objectUID, $propertyChange->value);
            }
        }

        if ($saveGrants) {
            $this->insertGrants($object, $oldObject);
            $this->updateGrants($object, $oldObject);
            $this->deleteGrants($object, $oldObject);
        }

        if ($saveChanges)
            $this->saveObjectChange($this->objectChange);

        return $this->objectChange;
    }

    /**
     *
     * Updates the object user
     * @param NGObject $object Object to update
     */
    private function updateObject(NGObject $object)
    {
        $query = new NGDBQueryUpdate ();
        $query->table = self::TableObject;
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        $query->updateCriterias = array(new NGDBQPartCriteria (self::ColumnOwner, $object->owner, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnOwnerGroup, $object->ownerGroup, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnParentUID, $object->parentUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnChangeDate, $object->changeDate, NGDBQPartCriteria::TypeString));
        $query->executeQuery();
    }

    /**
     *
     * Saves object changes
     * @param NGObjectChange $objectChange
     */
    public function saveObjectChange(NGObjectChange $objectChange)
    {
        $insertQuery = new NGDBQueryInsert ();
        $insertQuery->table = self::TableObjectChange;
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnChangeUID, $objectChange->changeUID, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnChangeType, $objectChange->changeType, NGDBQPartCriteria::TypeNumeric);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnObjectUID, $objectChange->objectUID, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnClass, $objectChange->class, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnOwner, $objectChange->owner, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnOwnerGroup, $objectChange->ownerGroup, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnChangeOwner, $objectChange->changeOwner, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnChangeDate, $objectChange->changeDate, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnAnnotation, $objectChange->annotation, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnRevisionUID, $objectChange->revisionUID, NGDBQPartCriteria::TypeString);
        $insertQuery->insertCriterias [] = new NGDBQPartCriteria (self::ColumnParentUID, $objectChange->parentUID, NGDBQPartCriteria::TypeString);

        $insertQuery->executeQuery();

        /* Save property changes */
        foreach ($objectChange->properties as $propertyChange) {
            /* @var $propertyChange NGPropertyChange */
            $insertQuery = new NGDBQueryInsert ();
            $insertQuery->table = self::TablePropertyChange;
            $insertQuery->insertCriterias = array(new NGDBQPartCriteria (self::ColumnChangeUID, $objectChange->changeUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnChangeType, $propertyChange->changeType, NGDBQPartCriteria::TypeNumeric), new NGDBQPartCriteria (self::ColumnDomain, $propertyChange->domain, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnLang, $propertyChange->lang, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnType, $propertyChange->type, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnName, $propertyChange->name, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnIndex, $propertyChange->index, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnUnique, $propertyChange->unique, NGDBQPartCriteria::TypeBoolean), new NGDBQPartCriteria ($this->propertyColumns [$propertyChange->type], $propertyChange->value, $this->propertyTypes [$propertyChange->type]));
            $insertQuery->executeQuery();
        }

        /* save grant changes */
        foreach ($objectChange->grants as $action => $owners) {
            foreach ($owners as $owner => $grantChange) {
                /* @var $grantChange NGGrantChange */
                $insertQuery = new NGDBQueryInsert ();
                $insertQuery->table = self::TableGrantChange;
                $insertQuery->insertCriterias = array(new NGDBQPartCriteria (self::ColumnChangeUID, $objectChange->changeUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnChangeType, $grantChange->changeType, NGDBQPartCriteria::TypeNumeric), new NGDBQPartCriteria (self::ColumnAction, $action, NGDBQPartCriteria::TypeNumeric), new NGDBQPartCriteria (self::ColumnOwner, $owner, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnAccess, $grantChange->access, NGDBQPartCriteria::TypeNumeric));
                $insertQuery->executeQuery();
            }
        }
    }

    /**
     *
     * Applys an object change
     * @param NGObjectChange $objectChange
     */
    public function applyObjectChange($objectChange)
    {
        switch ($objectChange->changeType) {
            case NGObjectChange::ChangeTypeInsert :
                $objectChange->creationDate = $objectChange->changeDate;
                $this->insertObject($objectChange);
                break;
            case NGObjectChange::ChangeTypeUpdate :
                $this->updateObject($objectChange);
                break;
            case NGObjectChange::ChangeTypeDelete :
                $this->deleteRevision($objectChange->objectUID, $objectChange->revisionUID);
                break;
        }

        foreach ($objectChange->properties as $propertyChange) {
            /* @var $property NGPropertyChange */
            switch ($propertyChange->changeType) {
                case NGObjectChange::ChangeTypeInsert :
                    $this->insertProperty($objectChange, $propertyChange);
                    break;
                case NGObjectChange::ChangeTypeUpdate :
                    $this->updateProperty($objectChange, $propertyChange);
                    break;
                case NGObjectChange::ChangeTypeDelete :
                    $this->deleteProperty($objectChange, $propertyChange);
                    break;
            }
        }

        foreach ($objectChange->grants as $action => $grant) {
            foreach ($grant as $owner => $grantChange) {
                /* @var $grantChange NGGrantChange */
                switch ($grantChange->changeType) {
                    case NGObjectChange::ChangeTypeInsert :
                        $this->insertGrant($objectChange, $action, $owner, $grantChange->access);
                        break;
                    case NGObjectChange::ChangeTypeUpdate :
                        $this->updateGrant($objectChange, $action, $owner, $grantChange->access);
                        break;
                    case NGObjectChange::ChangeTypeDelete :
                        $this->deleteGrant($objectChange, $action, $owner);
                        break;
                }
            }
        }

    }

    /**
     *
     * Deletes an object from the database
     * @param NGObject $object Object to be deleted
     * @param string $annotation Annotation
     * @return NGObjectChange Changes
     */
    public function deleteObject($objectUID, $annotation = '', $revisionUID = null)
    {
        if ($revisionUID === null) {
            $revisionUIDs = $this->getRevisionUIDs($objectUID);
        } else {
            $revisionUIDs = array($revisionUID);
        }

        $objectChanges = array();

        foreach ($revisionUIDs as $revisionToDelete) {
            $objectChanges [] = $this->deleteObjectRevision($objectUID, $revisionToDelete, $annotation);
        }

        $this->removeStorageFolder($objectUID);

        return $objectChanges;
    }

    /**
     *
     * Deletes the storage folder of a file
     * @param string $objectUID
     */
    private function removeStorageFolder($objectUID)
    {
        $objectStorePath = substr(NGUtil::pathForUID($objectUID), 0, -1);

        $storePath = NGUtil::joinPaths(NGConfig::storePath(), $objectStorePath);

        if (file_exists($storePath)) {
            NGUtil::emptyFolder($storePath);
        };

        // Clean up the hierarchy


        while ($objectStorePath != '') {
            $storePath = NGUtil::joinPaths(NGConfig::storePath(), $objectStorePath);

            if (!file_exists($storePath))
                break;
            if (!NGUtil::isEmptyDir($storePath))
                break;
            @rmdir($storePath);

            $slashPos = strrpos($objectStorePath, '/');
            if ($slashPos === false) {
                $objectStorePath = '';
            } else {
                $objectStorePath = substr($objectStorePath, 0, $slashPos);
            }
        };
    }

    /**
     *
     * Puts an object into the trash
     * @param string $objectUID UID of object to recyle
     * @param string $annotation Annotation
     */
    public function trashObject($objectUID, $annotation = '', $revisionUID = null)
    {
        if ($revisionUID === null) {
            $revisionUIDs = $this->getRevisionUIDs($objectUID);
        } else {
            $revisionUIDs = array($revisionUID);
        }

        $objectChanges = array();

        foreach ($revisionUIDs as $revisionToDelete) {
            $objectChanges [] = $this->trashObjectRevision($objectUID, $revisionToDelete, $annotation);
        }

        return $objectChanges;
    }

    /**
     *
     * Gets back an object from trash
     * @param string $objectUID
     * @param string $annotation
     */
    public function unTrashObject($objectUID, $annotation = '', $parentUID = '')
    {
        $revisionUIDs = $this->getRevisionUIDs($objectUID);

        $objectChanges = array();

        foreach ($revisionUIDs as $revisionToDelete) {
            $objectChanges [] = $this->unTrashObjectRevision($objectUID, $revisionToDelete, $annotation, $parentUID);
        }

        return $objectChanges;
    }

    /**
     *
     * Pulls a revision from the trash
     * @param string $objectUID Object to untrash
     * @param string $revisionUID revision to untrash
     * @param string $annotation annotation to place
     * @param string $parentUID new parent uid. Leave empty if use original uid
     */
    public function unTrashObjectRevision($objectUID, $revisionUID, $annotation, $parentUID = '')
    {
        $this->domains = array();
        $this->langs = array();

        $object = $this->loadObject($objectUID, null, NGObject::ObjectTypeObject, $revisionUID, true, true, true, true);

        if (strcmp($object->parentUID, NGUtil::ObjectUIDRootTrash) != 0) {
            throw new NGNotFoundException ($objectUID);
        }

        if ($object == null) {
            throw new NGNotFoundException ($objectUID, $revisionUID);
        }

        $this->assertAccess(NGObject::ActionModify, $object);

        // Take back all grants


        foreach (NGRestObjectBase::$valueToAction as $action) {
            unset ($object->grants [$action] [$object->owner]);
        }

        $reducedProperties = array();

        foreach ($object->properties as $property) {
            /* NGProperty $property */

            $found = false;

            if ($property->domain == NGUtil::DomainTrash) {
                if ($property->name == self::ColumnParentUID) {
                    $object->parentUID = $property->value;
                    $found = true;
                }
                if ($property->name == self::ColumnOwner) {
                    $object->owner = $property->value;
                    $found = true;
                }
                if ($property->name == self::ColumnOwnerGroup) {
                    $object->ownerGroup = $property->value;
                    $found = true;
                }

                // Restore backed up grants


                foreach (NGRestObjectBase::$actionToValue as $action => $value) {
                    if ($property->name == $value) {
                        $object->grants [$action] [$property->index] = NGRestObjectBase::$valueToAccess [$property->value];
                        $found = true;
                    }
                }
            }

            if (!$found)
                $reducedProperties [] = $property;
        }

        $object->properties = $reducedProperties;

        if ($parentUID !== '') {
            $object->parentUID = $parentUID;
        }

        $parentObject = $this->loadObject($object->parentUID, null, NGObject::ObjectTypeObject, '', false, false, true, false);

        if ($parentObject == null) {
            throw new NGNotFoundException ($objectUID, $revisionUID);
        }

        $this->assertAccess(NGObject::ActionAdd, $parentObject);

        return $this->saveObject($object, $annotation, true, true, true, true);

    }

    /**
     *
     * Puts an object revision into the trash
     * @param string $objectUID object to tash
     * @param string $revisionUID revision
     * @param string $annotation annotation
     */
    public function trashObjectRevision($objectUID, $revisionUID, $annotation)
    {
        $this->domains = array();
        $this->langs = array();
        $object = $this->loadObject($objectUID, null, NGObject::ObjectTypeObject, $revisionUID, true, true, true);

        if ($object == null) {
            throw new NGNotFoundException ($objectUID, $revisionUID);
        }

        $this->assertAccess(NGObject::ActionDelete, $object);

        // Backup any given grants for the trashing user


        $effectiveGrants = $this->getGrantsForUser($object, NGSession::getInstance()->user, null, true);

        foreach ($effectiveGrants as $action => $access) {
            if ($access != NGObject::AccessUndefined) {
                if (array_key_exists(NGSession::getInstance()->user->objectUID, $object->grants [$action])) {
                    $object->properties [] = new NGProperty (NGRestObjectBase::$actionToValue [$action], NGProperty::TypeString, NGRestObjectBase::$accessToValue [$object->grants [$action] [NGSession::getInstance()->user->objectUID]], NGUtil::LanguageNeutral, NGUtil::DomainTrash, $object->owner);
                }
                $object->grants [$action] [NGSession::getInstance()->user->objectUID] = $access;
            }
        }

        $propertyParent = new NGProperty (self::ColumnParentUID, NGProperty::TypeUID, $object->parentUID, NGUtil::LanguageNeutral, NGUtil::DomainTrash);
        $propertyOwner = new NGProperty (self::ColumnOwner, NGProperty::TypeUID, $object->owner, NGUtil::LanguageNeutral, NGUtil::DomainTrash);
        $propertyOwnergroup = new NGProperty (self::ColumnOwnerGroup, NGProperty::TypeUID, $object->ownerGroup, NGUtil::LanguageNeutral, NGUtil::DomainTrash);

        if (!$this->propertyExists($propertyParent, $object->properties))
            $object->properties [] = $propertyParent;
        if (!$this->propertyExists($propertyOwner, $object->properties))
            $object->properties [] = $propertyOwner;
        if (!$this->propertyExists($propertyOwnergroup, $object->properties))
            $object->properties [] = $propertyOwnergroup;

        $object->parentUID = NGUtil::ObjectUIDRootTrash;
        $object->owner = NGSession::getInstance()->user->objectUID;
        $object->ownerGroup = NGSession::getInstance()->user->maingroup;

        return $this->saveObject($object, $annotation, true, true, true, true);
    }

    /**
     *
     * Deletes a object revision
     * @param string $objectUID UID of object
     * @param string $revisionUID UID of revision
     * @param string $annotation Annotation
     */
    public function deleteObjectRevision($objectUID, $revisionUID, $annotation)
    {
        $this->domains = array();

        $object = $this->loadObject($objectUID, null, NGObject::ObjectTypeObject, $revisionUID, true, true, true, true);

        if ($object == null) {
            throw new NGNotFoundException ($objectUID, $revisionUID);
        }

        $this->assertAccess(NGObject::ActionDelete, $object);

        $objectChange = new NGObjectChange (NGUtil::createUID(), NGObjectChange::ChangeTypeDelete, $objectUID, $object->class, $object->owner, NGUtil::now(), $annotation, $revisionUID, $object->ownerGroup, NGSession::getInstance()->user->objectUID, $object->parentUID);

        $this->deleteAllProperties($objectChange);
        $this->deleteAllGrants($objectChange);

        $this->deleteRevision($objectUID, $revisionUID);

        $this->saveObjectChange($objectChange);

        return $objectChange;
    }

    /**
     *
     * Deletes a revision
     * @param string $objectUID
     * @param string $revisionUID
     */
    public function deleteRevision($objectUID, $revisionUID)
    {
        $deleteQuery = new NGDBQueryDelete ();
        $deleteQuery->table = self::TableObject;
        $deleteQuery->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        $deleteQuery->executeQuery();

    }

    /**
     *
     * Fetches all revision UIDs of an object
     * @param string $objectUID UID of object
     */
    public function getRevisionUIDs($objectUID)
    {
        $revisionsQuery = new NGDBQuerySelect ();
        $revisionsQuery->table = self::TableObject;
        $revisionsQuery->colums = array(self::ColumnRevisionUID);
        $revisionsQuery->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectUID, NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareIs);

        $result = $revisionsQuery->executeQuery();

        $row = $result->fetch_assoc();

        $revisionUIDs = array();

        while ($row) {

            $revisionUIDs [] = $row [self::ColumnRevisionUID];

            $row = $result->fetch_assoc();
        }

        $result->close();

        if (count($revisionUIDs) == 0) {
            throw new NGNotFoundException ($objectUID);
        }

        return $revisionUIDs;
    }

    /**
     *
     * Deletes all properties for an object and stores journal
     * @param NGObject $object Object to be deleted
     */
    private function deleteAllProperties(NGObjectChange $objectChange)
    {
        $selectQuery = new NGDBQuerySelect ();

        $selectQuery->table = self::TableProperty;

        $selectQuery->colums = array(self::ColumnDomain, self::ColumnLang, self::ColumnName, self::ColumnIndex, self::ColumnUnique, self::ColumnType, self::ColumnValueInt, self::ColumnValueFloat, self::ColumnValueString, self::ColumnValueText, self::ColumnValueFulltext);

        $selectQuery->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectChange->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        $selectQuery->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $objectChange->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

        $result = $selectQuery->executeQuery();

        $row = $result->fetch_assoc();

        while ($row) {
            $propertyChange = new NGPropertyChange (NGPropertyChange::ChangeTypeDelete, $row [self::ColumnName], $row [self::ColumnType], $this->convertToType($row [$this->propertyColumns [$row [self::ColumnType]]], $row [self::ColumnType]), $row [self::ColumnLang], $row [self::ColumnDomain], $row [self::ColumnIndex], $row [self::ColumnUnique]);
            $objectChange->properties [] = $propertyChange;
            $row = $result->fetch_assoc();
        }

        $result->close();

        $deleteQuery = new NGDBQueryDelete ();
        $deleteQuery->table = self::TableProperty;
        $deleteQuery->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectChange->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        $deleteQuery->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $objectChange->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        $deleteQuery->executeQuery();

    }

    /**
     *
     * Deletes all grants ...
     * @param NGObjectChange $objectChange
     */
    private function deleteAllGrants(NGObjectChange $objectChange)
    {
        $selectQuery = new NGDBQuerySelect ();

        $selectQuery->table = self::TableGrant;

        $selectQuery->colums = array(self::ColumnAction, self::ColumnOwner, self::ColumnAccess);

        $selectQuery->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectChange->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $objectChange->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));

        $result = $selectQuery->executeQuery();

        $row = $result->fetch_assoc();

        while ($row) {
            $objectChange->grants [$row [self::ColumnAction]] [$row [self::ColumnOwner]] = new NGGrantChange (NGGrantChange::ChangeTypeDelete, $row [self::ColumnAccess]);

            $row = $result->fetch_assoc();
        }

        $result->close();

        $deleteQuery = new NGDBQueryDelete ();
        $deleteQuery->table = self::TableGrant;
        $deleteQuery->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $objectChange->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $objectChange->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));

        $deleteQuery->executeQuery();
    }

    /**
     *
     * Inserts properties that are in the new object but not in the old one
     * @param NGObject $object new object
     * @param NGObject $oldObject old object
     */
    private function insertProperties(NGObject $object, NGObject $oldObject)
    {
        /* @var $object NGObject */
        /* @var $oldObject NGObject */

        foreach ($object->properties as $property) {
            /* @var $property NGProperty */
            if ($this->propertyExists($property, $oldObject->properties) === null) {

                $propertyChange = new NGPropertyChange (NGPropertyChange::ChangeTypeInsert, $property->name, $property->type, $property->value, $property->lang, $property->domain, $property->index, $property->unique);

                $this->objectChange->properties [] = $propertyChange;

                $this->insertProperty($object, $property);

            }
        }
    }

    /**
     *
     * Inserts property
     * @param NGObject $object
     * @param NGProperty $property
     */
    private function insertProperty(NGObject $object, NGProperty $property)
    {
        $query = new NGDBQueryInsert ();
        $query->table = self::TableProperty;
        $query->insertCriterias = array(new NGDBQPartCriteria (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnDomain, $property->domain, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnLang, $property->lang, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnType, $property->type, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnName, $property->name, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnIndex, $property->index, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnUnique, $property->unique, NGDBQPartCriteria::TypeBoolean), new NGDBQPartCriteria (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria ($this->propertyColumns [$property->type], $property->value, $this->propertyTypes [$property->type]));
        $query->executeQuery();
    }

    private function updateFiles(NGObject $object)
    {
        $path = NGUtil::joinPaths(NGConfig::storePath(), NGUtil::pathForUID($object->objectUID));

        foreach ($object->properties as $property) {
            if ($property->update) {
                while (file_exists(NGUtil::joinPaths($path, $property->value))) {
                    $property->value = NGUtil::getAlternativeValue($property->value);
                }
            }
        }
    }

    private function checkUniqueProperties(NGObject $object, $resolveCollisions)
    {
        $collisions = array();

        for ($i = 0; $i < count($object->properties); $i++) {
            if ($object->properties [$i]->unique) {
                $existingUID = $this->checkUniqueProperty($object->properties [$i], $object->properties [$i]->value, $object);

                if ($existingUID !== '') {
                    $newValue = '';

                    if ($object->properties [$i]->type == NGProperty::TypeString) {
                        $newValue = NGUtil::getAlternativeValue($object->properties [$i]->value);

                        while ($this->checkUniqueProperty($object->properties [$i], $newValue, $object) !== '') {
                            $newValue = NGUtil::getAlternativeValue($newValue);
                        }
                    }

                    if ($resolveCollisions && $newValue !== '') {
                        $object->properties [$i]->value = $newValue;
                    } else {
                        $collision = array(self::CollisionName => $object->properties [$i]->name, self::CollisionDomain => $object->properties [$i]->domain, self::CollisionValue => $object->properties [$i]->value, self::CollisionObjectUID => $existingUID);
                        if ($newValue !== '')
                            $collision [self::CollisionAlternative] = $newValue;
                        $collisions [] = $collision;
                    }
                }
            }
        }

        if (count($collisions) > 0) {
            throw new NGDuplicateValueException ($collisions);
        }
    }

    private function checkUniqueProperty(NGProperty $property, $value, NGObject $object)
    {
        // Ignore empty string properties
        if ($property->type == NGProperty::TypeString) {
            if (strcmp($property->value, '') == 0) {
                return '';
            }
        }

        $existingObjects = $this->queryObjects($object->class, array(new NGPropertyCriteria ($property->name, $property->type, $value, true, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, $property->lang, $property->domain, $property->index)), NGPropertyCriteria::SortNone, NGObject::ObjectTypeObject, $object->revisionUID, '', $object->parentUID);
        foreach ($existingObjects as $existingObject) {
            /* @var NGObject */
            if (strcmp($existingObject->objectUID, $object->objectUID) != 0) {
                if (strcmp($existingObject->parentUID, NGUtil::ObjectUIDRootTrash) != 0) {
                    return ($existingObject->objectUID);
                }
            }
        }
        return '';
    }

    /**
     *
     * Checks, if a property already exists
     * @param NGProperty $property Property to be checked
     * @param array $properties Array of Properties
     */
    private function propertyExists(NGProperty $property, $properties)
    {
        foreach ($properties as $compareProperty) {
            /* @var $compareProperty NGProperty */

            if ($property->name == $compareProperty->name) {
                if ($property->lang == $compareProperty->lang) {
                    if ($property->domain == $compareProperty->domain) {
                        if ($property->index == $compareProperty->index) {
                            return $compareProperty;
                        }
                    }
                }
            }
        }

        return NULL;
    }

    /**
     *
     * Inserts grants that are in the new object but not in the old one
     * @param NGObject $object new object
     * @param NGObject $oldObject old object
     */
    private function insertGrants(NGObject $object, NGObject $oldObject)
    {
        /* @var $object NGObject */
        /* @var $oldObject NGObject */

        foreach ($object->grants as $action => $grant) {
            foreach ($grant as $owner => $access) {
                if (!array_key_exists($owner, $oldObject->grants [$action])) {
                    $this->objectChange->grants [$action] [$owner] = new NGGrantChange (NGGrantChange::ChangeTypeInsert, $access);
                    $this->insertGrant($object, $action, $owner, $access);
                }
            }
        }
    }

    /**
     *
     * Insert a grant
     * @param NGObject $object
     * @param int $action
     * @param string $owner
     * @param int $access
     */
    private function insertGrant(NGObject $object, $action, $owner, $access)
    {
        $query = new NGDBQueryInsert ();
        $query->table = self::TableGrant;
        $query->insertCriterias = array(new NGDBQPartCriteria (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnAction, $action, NGDBQPartCriteria::TypeNumeric), new NGDBQPartCriteria (self::ColumnOwner, $owner, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnAccess, $access, NGDBQPartCriteria::TypeNumeric));
        $query->executeQuery();
    }

    /**
     *
     * Update grants, that have changed
     * @param NGObject $object new object
     * @param NGObject $oldObject old object
     */
    private function updateGrants(NGObject $object, NGObject $oldObject)
    {
        /* @var $object NGObject */
        /* @var $oldObject NGObject */

        foreach ($object->grants as $action => $grant) {
            foreach ($grant as $owner => $access) {
                if (array_key_exists($owner, $oldObject->grants [$action])) {
                    if ($access != $oldObject->grants [$action] [$owner]) {
                        $this->objectChange->grants [$action] [$owner] = new NGGrantChange (NGGrantChange::ChangeTypeUpdate, $access);
                        $this->updateGrant($object, $action, $owner, $access);
                    }
                }
            }
        }
    }

    /**
     *
     * Update a grant
     * @param NGObject $object
     * @param int $action
     * @param string $owner
     * @param int $access
     */
    private function updateGrant(NGObject $object, $action, $owner, $access)
    {
        $query = new NGDBQueryUpdate ();
        $query->table = self::TableGrant;
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnAction, $action, NGDBQPartCriteriaWhere::TypeNumeric, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnOwner, $owner, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        $query->updateCriterias = array(new NGDBQPartCriteria (self::ColumnAccess, $access, NGDBQPartCriteria::TypeNumeric));
        $query->executeQuery();
    }

    /**
     *
     * Delete grants that are no longer there
     * @param NGObject $object new object
     * @param NGObject $oldObject old object
     */
    private function deleteGrants(NGObject $object, NGObject $oldObject)
    {
        /* @var $object NGObject */
        /* @var $oldObject NGObject */

        foreach ($oldObject->grants as $action => $grant) {
            foreach ($grant as $owner => $access) {
                if (!array_key_exists($owner, $object->grants [$action])) {

                    $this->objectChange->grants [$action] [$owner] = new NGGrantChange (NGGrantChange::ChangeTypeDelete, $access);
                    $this->deleteGrant($object, $action, $owner);
                }
            }
        }
    }

    /**
     *
     * Delete a grant
     * @param NGObject $object
     * @param int $action
     * @param string $owner
     */
    private function deleteGrant(NGObject $object, $action, $owner)
    {
        $query = new NGDBQueryDelete ();
        $query->table = self::TableGrant;
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnAction, $action, NGDBQPartCriteriaWhere::TypeNumeric, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnOwner, $owner, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        $query->executeQuery();
    }

    /**
     *
     * Updates properties that are in both objects but have changed
     * @param NGObject $object new object
     * @param NGObject $oldObject old object
     */
    private function updateProperties(NGObject $object, NGObject $oldObject)
    {

        foreach ($object->properties as $property) {
            /* @var $property NGProperty */

            if (!$property->readOnly) {

                $oldProperty = $this->propertyExists($property, $oldObject->properties);
                if ($oldProperty !== null) {
                    if (!($property->isEqualTo($oldProperty) && ($property->unique == $oldProperty->unique))) {

                        $propertyChange = new NGPropertyChange (NGPropertyChange::ChangeTypeUpdate, $property->name, $property->type, $property->value, $property->lang, $property->domain, $property->index, $property->unique);

                        $this->objectChange->properties [] = $propertyChange;

                        $this->updateProperty($object, $property);
                    }
                }
            }
        }
    }

    private function updateProperty(NGObject $object, NGProperty $property)
    {
        $query = new NGDBQueryUpdate ();
        $query->table = self::TableProperty;
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnDomain, $property->domain, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnLang, $property->lang, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnName, $property->name, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnIndex, $property->index, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        $query->updateCriterias = array(new NGDBQPartCriteria ($this->propertyColumns [$property->type], $property->value, $this->propertyTypes [$property->type]), new NGDBQPartCriteria (self::ColumnType, $property->type, NGDBQPartCriteria::TypeNumeric), new NGDBQPartCriteria (self::ColumnUnique, $property->unique, NGDBQPartCriteria::TypeBoolean));
        $query->executeQuery();
    }

    /**
     *
     * Deletes properties that are no longer in the new object
     * @param NGObject $object new object
     * @param NGObject $oldObject old object
     */
    private function deleteProperties(NGObject $object, NGObject $oldObject)
    {
        /* @var $object NGObject */
        /* @var $oldObject NGObject */

        foreach ($oldObject->properties as $property) {
            /* @var $property NGProperty */
            if ($this->propertyExists($property, $object->properties) === null) {

                $propertyChange = new NGPropertyChange (NGPropertyChange::ChangeTypeDelete, $property->name, $property->type, $property->value, $property->lang, $property->domain, $property->index, $property->unique);

                $this->objectChange->properties [] = $propertyChange;

                $this->deleteProperty($object, $property);
            }
        }
    }

    /**
     *
     * Delete a property
     * @param NGObject $object
     * @param NGProperty $property
     */
    private function deleteProperty(NGObject $object, NGProperty $property)
    {
        $query = new NGDBQueryDelete ();
        $query->table = self::TableProperty;
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnDomain, $property->domain, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnLang, $property->lang, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnName, $property->name, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnIndex, $property->index, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        $query->executeQuery();
    }

    /**
     *
     * Inserts a new object into the database
     * @param NGObject $object new object
     */
    private function insertObject(NGObject $object)
    {
        /* @var $object NGObject */

        $query = new NGDBQueryInsert ();
        $query->table = self::TableObject;
        $query->insertCriterias = array(new NGDBQPartCriteria (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnClass, $object->class, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnOwner, $object->owner, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnOwnerGroup, $object->ownerGroup, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnChangeDate, $object->changeDate, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnCreationDate, $object->creationDate, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnParentUID, $object->parentUID, NGDBQPartCriteria::TypeString));

        $query->executeQuery();
    }

    /**
     * Fetches object properties from database
     * @param NGObject $object
     */
    private function loadProperties(NGObject $object)
    {

        $query = new NGDBQuerySelect ();

        $query->table = self::TableProperty;

        $query->colums = array(self::ColumnDomain, self::ColumnLang, self::ColumnName, self::ColumnIndex, self::ColumnUnique, self::ColumnType, self::ColumnValueInt, self::ColumnValueFloat, self::ColumnValueString, self::ColumnValueText, self::ColumnValueFulltext);

        $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

        if (count($this->domains) > 0) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnDomain, $this->domains, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        if (count($this->langs) > 0) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (self::ColumnLang, $this->langs, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        $result = $query->executeQuery();

        $row = $result->fetch_assoc();

        while ($row) {
            $name = $row [self::ColumnName];
            $property = new NGProperty ($name, $row [self::ColumnType], $this->convertToType($row [$this->propertyColumns [$row [self::ColumnType]]], $row [self::ColumnType]), $row [self::ColumnLang], $row [self::ColumnDomain], $row [self::ColumnIndex], $row [self::ColumnUnique]);

            if ($property->type == NGProperty::TypeFile) {
                $property->fileState = $this->getFileState($object->objectUID, $property->value);
            }

            $object->properties [] = $property;

            $row = $result->fetch_assoc();
        }

        $result->close();
    }

    /**
     *
     * Loads grants
     * @param NGObject $object
     */
    private function loadGrants(NGObject $object)
    {
        $query = new NGDBQuerySelect ();

        $query->table = self::TableGrant;

        $query->colums = array(self::ColumnAction, self::ColumnOwner, self::ColumnAccess);

        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $object->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $object->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));

        $result = $query->executeQuery();

        $row = $result->fetch_assoc();

        while ($row) {
            $action = ( int )$row [self::ColumnAction];
            $access = ( int )$row [self::ColumnAccess];

            if ($action >= NGObject::ActionView && $action <= NGObject::ActionAdmin) {
                $object->grants [$action] [$row [self::ColumnOwner]] = $access;
            }

            $row = $result->fetch_assoc();
        }

        $result->close();
    }

    /**
     *
     * Converts to correct PHP-Type
     * @param string Value to be casted
     * @param int $type Property Type
     */
    private function convertToType($value, $type)
    {
        switch ($type) {
            case NGProperty::TypeBool :
                return NGUtil::stringToBool($value);
            case NGProperty::TypeDateTime :
            case NGProperty::TypeString :
            case NGProperty::TypeText :
            case NGProperty::TypeFulltext :
            case NGProperty::TypeUID :
            case NGProperty::TypeFile :
                return ( string )$value;
            case NGProperty::TypeFloat :
                return ( float )$value;
            case NGProperty::TypeInt :
                return ( int )$value;
        }
    }

    /**
     *
     * Get the grants for a given user
     * @param NGUser $user
     * @param boolean $recursive
     * @param array $parentGrantsForUser
     * @return NGGrants
     */
    public function getGrantsForUser(NGObject $object, NGUser $user, $parentGrantsForUser = null, $allowTrashedObjects = false)
    {
        $grantsForUser = array();

        if (!$allowTrashedObjects) {
            if (strcmp($object->parentUID, NGUtil::ObjectUIDRootTrash) == 0) {
                throw new NGInTrashException ($object->objectUID);
            }
        }

        foreach ($object->grants as $action => $access) {
            $grantsForUser [$action] = $this->getGrantForUser($access, $user);
        };

        if ($object->parentUID !== '') {

            if ($parentGrantsForUser === null) {
                $parentObject = $this->loadObject($object->parentUID, null, NGObject::ObjectTypeObject, $object->revisionUID, false, true, false);

                if ($parentObject === null && $object->revisionUID !== '') {
                    /* when loading revision, try to load parent without revision */
                    $parentObject = $this->loadObject($object->parentUID, null, NGObject::ObjectTypeObject, '', false, true, false);
                }

                if ($parentObject === null) {
                    throw new Exception ('Object ' . $object->objectUID . ' has no parent', 20000);
                }

                $parentGrantsForUser = $this->getGrantsForUser($parentObject, $user, null, $allowTrashedObjects);
            }

            foreach ($grantsForUser as $action => $access) {
                if ($grantsForUser [$action] === NGObject::AccessUndefined) {
                    $grantsForUser [$action] = $parentGrantsForUser [$action];
                };
            };
        }

        return $grantsForUser;
    }

    /**
     *
     * Get a special grant for a given user
     * @param array $groupsAndUsers Groups and/or users who have a grant
     * @param NGUser $user User to check grant against
     */
    private function getGrantForUser($groupsAndUsers, NGUser $user)
    {
        $grant = NGUser::AccessUndefined;

        foreach ($groupsAndUsers as $groupOrUser => $level) {
            if ($groupOrUser === $user->objectUID || in_array($groupOrUser, $user->groups, true)) {
                if ($level > $grant) {
                    /* If grant provides a less restricted level of access, grant it */
                    $grant = $level;
                }
            }
        }
        return $grant;
    }

    /**
     *
     * Get Permissions on object for user
     * @param NGObject $object
     * @param NGUser $user
     * @param array Parents grants if known
     */
    public function loadPermissions(NGObject $object, NGUser $user, $parentGrants = null, $allowTrashedObjects = false)
    {
        $grantsForUser = $this->getGrantsForUser($object, $user, $parentGrants, $allowTrashedObjects);

        foreach ($grantsForUser as $action => $access) {
            if ($user->objectUID === NGUtil::ObjectUIDSystem) {
                $object->permissions [$action] = true;
            } else {
                $object->permissions [$action] = $this->getPermissionForUser($access, $object, $user);
            }
        }
    }

    /**
     *
     * Get effective grant depending on grant
     * @param int $grant
     * @param NGUser $user
     * @return boolean
     */
    private function getPermissionForUser($access, NGObject $object, NGUser $user)
    {
        switch ($access) {
            case NGObject::AccessDeny :
            case NGObject::AccessUndefined:
                /* user has no access at all */
                return false;
            case NGObject::AccessAny:
                /* user has universal access */
                return true;
            case NGObject::AccessOwner:
                /* user has access, if he owns object */
                return ($object->owner === $user->objectUID) ? true : false;
            case NGObject::AccessOwnerGroup:
                /* user has access, if his group owns object */
                return (in_array($object->ownerGroup, $user->groups, true)) ? true : false;
        }
    }

    /**
     *
     * Fetches a list of objects
     * @param string $class Class of object to load
     * @param array $propertyCritera List of properties to create or query
     * @param int $sortByDate Controls, if the result should by sorted by change_date
     * @param string $className Name of the class of the objects to return
     */
    public function queryObjects($class, $propertyCriterias, $sortByDate, $className = NGObject::ObjectTypeObject, $revisionUID = '', $objectUID = '', $parentUID = '', $ancestorLevel = 0)
    {
        $query = new NGDBQuerySelect ();
        $query->table = new NGDBQPartTableAs (self::TableObject, self::AliasObject);

        // Setup the default columns


        $query->colums = array(new NGDBQPartAliasColumn (self::AliasObject, self::ColumnObjectUID), new NGDBQPartAliasColumn (self::AliasObject, self::ColumnRevisionUID), new NGDBQPartAliasColumn (self::AliasObject, self::ColumnParentUID), new NGDBQPartAliasColumn (self::AliasObject, self::ColumnClass), new NGDBQPartAliasColumn (self::AliasObject, self::ColumnOwner), new NGDBQPartAliasColumn (self::AliasObject, self::ColumnOwnerGroup), new NGDBQPartAliasColumn (self::AliasObject, self::ColumnChangeDate), new NGDBQPartAliasColumn (self::AliasObject, self::ColumnCreationDate));

        // Filter by class, if set


        if ($class) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnClass), $class, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        // Filter by Revision, if set


        if ($revisionUID !== null) {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnRevisionUID), $revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        // Filter by UID, if set


        if ($objectUID !== '') {
            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnObjectUID), $objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
        }

        // Filter by parentUID, if set

        if ($parentUID !== '') {
            if ($ancestorLevel > 0) {

                // Run up ancestry

                for ($i = 0; $i < $ancestorLevel; $i++) {
                    $query->joins [] = new NGDBQPartJoin (
                        new NGDBQPartTableAs (self::TableObject, self::AliasObject . $i), array(
                            new NGDBQPartOn (new NGDBQPartAliasColumn (self::AliasObject . ($i == 0 ? '' : $i - 1), self::ColumnParentUID), new NGDBQPartAliasColumn (self::AliasObject . $i, self::ColumnObjectUID)),
                            new NGDBQPartOn (new NGDBQPartAliasColumn (self::AliasObject . ($i == 0 ? '' : $i - 1), self::ColumnRevisionUID), new NGDBQPartAliasColumn (self::AliasObject . $i, self::ColumnRevisionUID))
                        )
                    );

                    $query->colums [] = new NGDBQPartAliasColumnAs (self::AliasObject . $i, self::ColumnObjectUID, self::AliasAncestorUID . $i);

                }
                $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasObject . ($ancestorLevel - 1), self::ColumnParentUID), $parentUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
            } else {
                $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnParentUID), $parentUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
            }
        }


        // Check all criterias


        $i = 0;

        foreach ($propertyCriterias as $propertyCriteria) {
            /* @var $propertyCriteria NGPropertyCriteria */

            // Join instance of property table


            $query->joins [] = new NGDBQPartJoin (new NGDBQPartTableAs (self::TableProperty, self::AliasProperty . $i), array(new NGDBQPartOn (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnObjectUID), new NGDBQPartAliasColumn (self::AliasProperty . $i, self::ColumnObjectUID)), new NGDBQPartOn (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnRevisionUID), new NGDBQPartAliasColumn (self::AliasProperty . $i, self::ColumnRevisionUID))));

            // Select the row of the desired property


            // Select name


            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasProperty . $i, self::ColumnName), $propertyCriteria->name, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

            // Select index


            if ($propertyCriteria->index != "") {
                $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasProperty . $i, self::ColumnIndex), $propertyCriteria->index, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);
            }

            // Select domain


            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasProperty . $i, self::ColumnDomain), $propertyCriteria->domain, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

            // Select language


            $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasProperty . $i, self::ColumnLang), $propertyCriteria->lang, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs);

            // Output the property? Add to output columns!


            if ($propertyCriteria->output) {
                $query->colums [] = new NGDBQPartAliasColumnAs (self::AliasProperty . $i, $this->propertyColumns [$propertyCriteria->type], self::AliasResult . $i);
                $query->colums [] = new NGDBQPartAliasColumnAs (self::AliasProperty . $i, self::ColumnLang, self::AliasLanguage . $i);
                $query->colums [] = new NGDBQPartAliasColumnAs (self::AliasProperty . $i, self::ColumnIndex, self::AliasIndex . $i);
            };

            // Filter the property? Add additional where columns


            if ($propertyCriteria->compare != NGPropertyCriteria::CompareNone) {
                $query->whereCriterias [] = new NGDBQPartCriteriaWhere (new NGDBQPartAliasColumn (self::AliasProperty . $i, $this->propertyColumns [$propertyCriteria->type]), $propertyCriteria->value, $this->propertyTypes [$propertyCriteria->type], $propertyCriteria->compare);
            }

            // Sort by property? Add additional sort columns


            if ($propertyCriteria->sort != NGPropertyCriteria::SortNone) {
                $query->orderColumns [] = new NGDBQPartOrderColumn (new NGDBQPartAliasColumn (self::AliasProperty . $i, $this->propertyColumns [$propertyCriteria->type]), ($propertyCriteria->sort == NGPropertyCriteria::SortDesc));
            }

            $i++;

        };

        // Sort by change_date of object


        if ($sortByDate != NGPropertyCriteria::SortNone) {
            $query->orderColumns [] = new NGDBQPartOrderColumn (new NGDBQPartAliasColumn (self::AliasObject, self::ColumnCreationDate), ($sortByDate == NGPropertyCriteria::SortDesc));
        }

        $s = $query->sql();

        $result = $query->executeQuery();

        // Create objects


        $return = array();

        $row = $result->fetch_assoc();

        while ($row) {

            // With indexed properties there could be more than one hit per object


            $object = null;

            // Check, if object does exist


            foreach ($return as $existingObject) {
                /* @var $existingObject NGObject */

                if ($existingObject->objectUID === $row [self::ColumnObjectUID]) {
                    if ($existingObject->revisionUID === $row [self::ColumnRevisionUID]) {
                        $object = $existingObject;
                        break;
                    }
                }
            }

            if ($object === null) {
                $object = new $className ();
                $object->objectUID = $row [self::ColumnObjectUID];
                $object->revisionUID = $row [self::ColumnRevisionUID];
                $object->parentUID = $row [self::ColumnParentUID];
                $object->class = $row [self::ColumnClass];
                $object->owner = $row [self::ColumnOwner];
                $object->ownerGroup = $row [self::ColumnOwnerGroup];
                $object->changeDate = $row [self::ColumnChangeDate];
                $object->creationDate = $row [self::ColumnCreationDate];
                $return [] = $object;
            }

            if ($ancestorLevel > 0) {
                $ancestorObjectUIDs = array();

                for ($i = 0; $i < $ancestorLevel; $i++) {
                    $ancestorObjectUIDs[] = $row[self::AliasAncestorUID . $i];
                }

                $object->ancestorObjectUIDs = $ancestorObjectUIDs;
            }

            // create visible properties


            $i = 0;

            // As with indexed properties, the property might already exist


            foreach ($propertyCriterias as $propertyCriteria) {
                if ($propertyCriteria->output) {
                    $found = false;

                    foreach ($object->properties as $existingProperty) {
                        /* @var $existingProperty NGProperty */
                        if ($existingProperty->name === $propertyCriteria->name) {
                            if ($existingProperty->domain === $propertyCriteria->domain) {
                                if ($existingProperty->index === $row [self::AliasIndex . $i]) {
                                    $found = true;
                                    break;
                                }
                            }
                        }

                    }

                    if (!$found) {
                        $object->properties [] = new NGProperty ($propertyCriteria->name, $propertyCriteria->type, $this->convertToType($row [self::AliasResult . $i], $propertyCriteria->type), $row [self::AliasLanguage . $i], $propertyCriteria->domain, $row [self::AliasIndex . $i], $object->revisionUID);
                    }
                }
                $i++;
            }

            foreach ($object->properties as $property) {
                if ($property->type == NGProperty::TypeFile)
                    $property->fileState = $this->getFileState($object->objectUID, $property->value);
            }

            if ($object instanceof NGObjectMapped) {
                $object->loadPropertiesMapped();
            }

            $row = $result->fetch_assoc();
        }

        $result->close();

        return $return;
    }

    /**
     *
     * Hierachically loads ancestors
     * @param string $objectUID
     * @param string $revisionUID
     * @throws NGNotFoundException
     */
    public function loadAncestors($objectUID, $revisionUID = '', $loadProperties = false, $loadGrants = false, $loadPermissions = false)
    {
        $query = new NGDBQuerySelect ();
        $query->table = self::TableObject;
        $query->colums = array(self::ColumnObjectUID, self::ColumnClass, self::ColumnOwnerGroup, self::ColumnOwner, self::ColumnChangeDate, self::ColumnCreationDate, self::ColumnRevisionUID, self::ColumnParentUID);

        $ancestorObjects = array();

        $nextObjectUID = $objectUID;
        $nextRevisionUID = $revisionUID;

        do {
            if ($nextObjectUID === NGUtil::ObjectUIDRootTrash) {
                throw new NGInTrashException ($objectUID);
            }

            $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnObjectUID, $nextObjectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs), new NGDBQPartCriteriaWhere (self::ColumnRevisionUID, $nextRevisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
            $result = $query->executeQuery();
            $row = $result->fetch_assoc();

            if ($row) {

                $ancestorObject = $this->loadObjectFromRow($row, NGObjectNamed::ObjectTypeObjectNamed, $loadProperties);

                if ($loadGrants || $loadPermissions) {
                    $this->loadGrants($ancestorObject);
                }
                if ($loadPermissions) {
                    $this->loadPermissions($ancestorObject, NGSession::getInstance()->user);
                }

                array_unshift($ancestorObjects, $ancestorObject);
                $nextObjectUID = $row [self::ColumnParentUID];
            } else {
                if ($nextRevisionUID !== '') {
                    // Switch to main revision uid
                    $nextRevisionUID = '';
                } else {
                    throw new NGNotFoundException ($nextObjectUID);
                }
            }

        } while ($nextObjectUID != '');

        return $ancestorObjects;
    }

    /**
     *
     * Safely moves object to new parent UID
     * @param string $objectUID
     * @param string $parentUID
     * @param string $annotation
     */
    public function moveObject($objectUID, $parentUID, $annotation, $resoveCollisions)
    {
        $revisionUIDs = $this->getRevisionUIDs($objectUID);

        $objectChanges = array();

        foreach ($revisionUIDs as $revisionUID) {
            $objectChanges [] = $this->moveObjectRevision($objectUID, $revisionUID, $parentUID, $annotation, $resoveCollisions);
        }

        return $objectChanges;
    }

    /**
     *
     * Safely moves object revision to new parent UID
     * @param string $objectUID
     * @param string $revisionUID
     * @param string $parentUID
     * @param string $annotation
     */
    public function moveObjectRevision($objectUID, $revisionUID, $parentUID, $annotation, $resolveCollisions)
    {
        // Check, if original object is writable
        $objectToMove = $this->loadObject($objectUID, null, NGObject::ObjectTypeObject, $revisionUID, true, false, true, false);
        if ($objectToMove == null)
            throw new NGNotFoundException ($objectUID);
        if (!$objectToMove->permissions [NGObject::ActionDelete])
            throw new NGAccessDeniedException (NGObject::ActionDelete, $objectUID);
        if (!$objectToMove->permissions [NGObject::ActionModify])
            throw new NGAccessDeniedException (NGObject::ActionModify, $objectUID);

        // Check, if new parent is writable
        $parentObject = $this->loadObject($parentUID, null, NGObject::ObjectTypeObject, '', false, false, true, false);
        if ($parentObject == null)
            throw new NGNotFoundException ($parentUID);
        if (!$parentObject->permissions [NGObject::ActionAdd])
            throw new NGAccessDeniedException (NGObject::ActionAdd, $parentUID);

        // Check, if object is not ancestor of new parent
        $ancestors = $this->loadAncestors($parentUID);
        foreach ($ancestors as $ancestor) {
            /* @var $ancestor NGAncestor */
            if ($ancestor->objectUID === $objectUID)
                throw new NGRecursionException ($parentUID, $objectUID);
        }

        // Move it, baby
        $objectToMove->parentUID = $parentUID;

        $this->checkUniqueProperties($objectToMove, $resolveCollisions);

        return $this->saveObject($objectToMove, $annotation, false, false, $resolveCollisions, false, false);
    }

    /**
     *
     * Asserts a certain access level to an object, throws an access denied exception if not granted
     * @param int $action Action to assert
     * @param NGObject $object Object to check
     */
    private function assertAccess($action, $object)
    {
        if (!$object->permissions [$action]) {
            throw new NGAccessDeniedException ($action, $object->objectUID);
        }
    }

    /**
     *
     * Retrieves file state information about a file
     * @param string $objectUID
     * @param string $filename
     * @return NGFileState Information about file
     */
    public function getFileState($objectUID, $filename)
    {

        $fileState = new NGFileState ();

        $filenamePart = $filename . '.part';

        $fileState->path = NGUtil::pathForUID($objectUID);
        $storePath = NGUtil::joinPaths(NGConfig::storePath(), $fileState->path);

        $pathMain = NGUtil::joinPaths($storePath, $filename);
        $pathPart = NGUtil::joinPaths($storePath, $filenamePart);

        if (file_exists($pathMain)) {
            $fileState->state = NGFileState::FileStateComplete;
            $fileState->size = filesize($pathMain);
        } else if (file_exists($pathPart)) {
            $fileState->state = NGFileState::FileStatePartial;
            $fileState->size = filesize($pathPart);
        } else {
            $fileState->state = NGFileState::FileStateMissing;
            $fileState->size = 0;
        }

        return $fileState;
    }

    /**
     *
     * Load a setting from database
     * @param string $id
     * @param string $class
     */
    public function loadSetting($id, $classFilter, $className = '')
    {
        $uid = NGUtil::idToUID(NGSetting::PrefixSetting, $id);

        if ($className === '')
            $className = $classFilter;

        $setting = $this->loadObject($uid, $classFilter, $className);

        if ($setting === null)
            $setting = new $className ();

        return $setting;
    }

    /**
     *
     * Gets the number of changes
     * @param string $previousChangeUID
     */
    public function getObjectChangesCount($previousChangeUID)
    {
        $query = new NGDBQuerySelect ();
        $query->table = self::TableObjectChange;
        $query->colums = array(new NGDBQPartFunctionAs (self::FunctionCount, self::ColumnChangeUID, self::FunctionCount));
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnChangeUID, $previousChangeUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareGreater));

        /* @var $result mysqli_result */
        $result = $query->executeQuery();

        $row = $result->fetch_row();

        return $row [0];
    }

    /**
     *
     * Gets the last change uid
     */
    public function getLastObjectChangeUID()
    {
        $query = new NGDBQuerySelect ();
        $query->table = self::TableObjectChange;
        $query->colums = array(new NGDBQPartFunctionAs (self::FunctionMax, self::ColumnChangeUID, self::FunctionMax));

        /* @var $result mysqli_result */
        $result = $query->executeQuery();

        if ($result->num_rows > 0) {
            $row = $result->fetch_row();
            return $row [0];
        } else {
            return NGUtil::ObjectUIDMin;
        }
    }

    /**
     *
     * Gets the next change uid
     * @param string $previousChangeUID
     */
    public function getNextChangeUID($previousChangeUID)
    {
        $query = new NGDBQuerySelect ();
        $query->table = self::TableObjectChange;
        $query->colums = array(self::ColumnChangeUID);
        $query->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnChangeUID, $previousChangeUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareGreater));
        $query->orderColumns = array(new NGDBQPartOrderColumn(self::ColumnChangeUID));
        $query->limitCount = 1;
        $query->limitOffset = 0;

        /* @var $result mysqli_result */
        $result = $query->executeQuery();


        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            return $row [self::ColumnChangeUID];
        } else {
            return '';
        }
    }

    public function writeMeta($id, $value)
    {
        if ($this->readMeta($id, NULL) !== NULL) {
            $this->updateMeta($id, $value);
        } else {
            $this->insertMeta($id, $value);
        }
    }

    /**
     *
     * Read meta
     * @param string $id
     */
    public function readMeta($id, $defaultValue = '')
    {
        $querySelect = new NGDBQuerySelect ();
        $querySelect->table = self::TableMeta;
        $querySelect->colums = array(self::ColumnValue);
        $querySelect->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnID, $id, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));

        /* @var $result mysqli_result */
        $result = $querySelect->executeQuery();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row [self::ColumnValue];
        } else {
            return $defaultValue;
        }
    }

    /**
     *
     * Update an existing meta
     * @param string $id
     * @param string $value
     */
    private function updateMeta($id, $value)
    {
        $queryUpdate = new NGDBQueryUpdate ();
        $queryUpdate->table = self::TableMeta;
        $queryUpdate->whereCriterias = array(new NGDBQPartCriteriaWhere (self::ColumnID, $id, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs));
        $queryUpdate->updateCriterias = array(new NGDBQPartCriteria (self::ColumnValue, $value, NGDBQPartCriteria::TypeString));
        $queryUpdate->executeQuery();
    }

    /**
     *
     * Insert a meta
     * @param string $id
     * @param string $value
     */
    private function insertMeta($id, $value)
    {
        $queryInsert = new NGDBQueryInsert ();
        $queryInsert->table = self::TableMeta;
        $queryInsert->insertCriterias = array(new NGDBQPartCriteria (self::ColumnID, $id, NGDBQPartCriteria::TypeString), new NGDBQPartCriteria (self::ColumnValue, $value, NGDBQPartCriteria::TypeString));
        $queryInsert->executeQuery();
    }
}