<?php
/**
 * 
 * Basic frame for REST call plus objectAdapter to load object related data
 * lang and domain is automatically set
 * 
 *
 *
 */
abstract class NGRestObjectBase extends NGRest {
	
	const NodeObject = 'object';
	const NodeObjectUID = 'objectuid';
	const NodeOwner = 'owner';
	const NodeOwnerGroup = 'ownergroup';
	const NodeType = 'type';
	const NodeClass = 'class';
	const NodeChangeDate = 'changedate';
	const NodeCreationDate = 'creationdate';
	const NodeChangeOwner = 'changeowner';
	const NodeDomain = 'domain';
	const NodeDomains = 'domains';
	const NodeLang = 'lang';
	const NodeLangs = 'langs';
	const NodeProperty = 'property';
	const NodeProperties = 'properties';
	const NodeName = 'name';
	const NodeIndex = 'index';
	const NodeChangeUID = 'changeuid';
	const NodeChangeType = 'changetype';
	const NodeLoadPropertyChanges = 'loadpropertychanges';
	const NodeLoadGrantChanges = 'loadgrantchanges';
	const NodeObjectChange = 'objectchange';
	const NodeObjectChanges = 'objectchanges';
	const NodePropertyChanges = 'propertychanges';
	const NodePropertyChange = 'propertychange';
	const NodeGrantChanges = 'grantchanges';
	const NodeGrantChange = 'grantchange';
	const NodeAnnotation = 'annotation';
	const NodePropertyCriteria = 'propertycriteria';
	const NodePropertyCriterias = 'propertycriterias';
	const NodeSortByDate = 'sortbydate';
	const NodeOutput = 'output';
	const NodeCompare = 'compare';
	const NodeSort = 'sort';
	const NodeObjects = 'objects';
	const NodeRevisionUID = 'revisionuid';
	const NodeParentUID = 'parentuid';
	const NodeNull = 'null';
	const NodeGrants='grants';
	const NodeGrant='grant';
	const NodeAction='action';
	const NodePermissions='permissions';
	const NodePermission='permission';
	const NodeLoadProperties='loadproperties';
	const NodeLoadGrants='loadgrants';
	const NodeLoadPermissions='loadpermissions';
	const NodeUnique='unique';
	const NodeAllowTrashedObjects='allowtrashedobjects';
	const NodeStage='stage';
	const NodePath='path';
	const NodeFilename='filename';
	const NodeSize='size';
	const NodeUpdate='update';
	const NodeResolveCollisions='resolvecollisions';
	const NodeReadOnly='readonly';
	const NodePreviousChangeUID='previouschangeuid';
	const NodeObjectChangesCount='objectchangescount';
	const NodeInstallRootObjects='installrootobjects';
	const NodeCount='count';
	
	const ValueTypeString = 'string';
	const ValueTypeInt = 'int';
	const ValueTypeFloat = 'float';
	const ValueTypeBool = 'bool';
	const ValueTypeDateTime = 'datetime';
	const ValueTypeText = 'text';
	const ValueTypeFulltext = 'fulltext';
	const ValueTypeUID = 'uid';
	const ValueTypeFile = 'file';
	
	const ValueChangeTypeInsert = 'insert';
	const ValueChangeTypeUpdate = 'update';
	const ValueChangeTypeDelete = 'delete';
	const ValueChangeTypeUnchanged = 'unchanged';
	
	const ValueCompareNone = 'none';
	const ValueCompareIs = 'is';
	const ValueCompareIsNot = 'isnot';
	const ValueCompareLike = 'like';
	const ValueCompareNotLike = 'notlike';
	const ValueCompareGreater = 'greater';
	const ValueCompareSmaller = 'smaller';
	const ValueCompareGreaterOrEqual = 'greaterorequal';
	const ValueCompareSmallerOrEqual = 'smallerorequal';
	const ValueCompareFulltext = 'fulltext';
	
	const ValueSortNone = 'none';
	const ValueSortAsc = 'asc';
	const ValueSortDesc = 'desc';

	const ValueActionView='view';
	const ValueActionModify='modify';
	const ValueActionAdd='add';
	const ValueActionDelete='delete';
	const ValueActionAdmin='admin';
	
	const ValueAccessDeny='deny';
	const ValueAccessOwner='owner';
	const ValueAccessOwnerGroup='ownergroup';
	const ValueAccessAny='any';	

	const ValueFileStateMissing='missing';
	const ValueFileStatePartial='partial';
	const ValueFileStateComplete='complete';
	
	
	const ValueTrue = 'true';
	
	/**
	 * 
	 * Converts fileStateToValue
	 * @var int
	 */	
	public static $fileStateToValue = array (
		NGFileState::FileStateMissing=>self::ValueFileStateMissing,
		NGFileState::FileStatePartial=>self::ValueFileStatePartial,
		NGFileState::FileStateComplete=>self::ValueFileStateComplete
	);
	
	/**
	 * 
	 * Converts type to value
	 * @var array
	 */
	public static $typeToValue = array (
		NGProperty::TypeString => self::ValueTypeString, 
		NGProperty::TypeInt => self::ValueTypeInt, 
		NGProperty::TypeFloat => self::ValueTypeFloat, 
		NGProperty::TypeBool => self::ValueTypeBool, 
		NGProperty::TypeDateTime => self::ValueTypeDateTime, 
		NGProperty::TypeText => self::ValueTypeText, 
		NGProperty::TypeFulltext => self::ValueTypeFulltext, 
		NGProperty::TypeUID => self::ValueTypeUID, 
		NGProperty::TypeFile => self::ValueTypeFile
	);
	
	/**
	 * 
	 * Converts value to type
	 * @var array
	 */
	public static $valueToType = array (
		self::ValueTypeString => NGProperty::TypeString, 
		self::ValueTypeInt => NGProperty::TypeInt, 
		self::ValueTypeFloat => NGProperty::TypeFloat, 
		self::ValueTypeBool => NGProperty::TypeBool, 
		self::ValueTypeDateTime => NGProperty::TypeDateTime, 
		self::ValueTypeText => NGProperty::TypeText, 
		self::ValueTypeFulltext => NGProperty::TypeFulltext, 
		self::ValueTypeUID => NGProperty::TypeUID,
		self::ValueTypeFile => NGProperty::TypeFile  
	);
	
	/**
	 * 
	 * Converts change type to value
	 * @var array
	 */
	public static $changeTypeToValue = array (
		NGObjectChange::ChangeTypeInsert => self::ValueChangeTypeInsert, 
		NGObjectChange::ChangeTypeUpdate => self::ValueChangeTypeUpdate, 
		NGObjectChange::ChangeTypeDelete => self::ValueChangeTypeDelete,
		NGObjectChange::ChangeTypeUnchanged => self::ValueChangeTypeUnchanged
	);
	
	/**
	 * 
	 * Converts value to change type
	 * @var array
	 */
	public static $valueToChangeType = array (
		self::ValueChangeTypeInsert => NGObjectChange::ChangeTypeInsert, 
		self::ValueChangeTypeUpdate => NGObjectChange::ChangeTypeUpdate, 
		self::ValueChangeTypeDelete => NGObjectChange::ChangeTypeDelete,
		self::ValueChangeTypeUnchanged => NGObjectChange::ChangeTypeUnchanged
	);

	/**
	 * 
	 * Converts compare to value
	 * @var array
	 */
	public static $compareToValue = array (
		NGPropertyCriteria::CompareNone => self::ValueCompareNone, 
		NGPropertyCriteria::CompareIs => self::ValueCompareIs, 
		NGPropertyCriteria::CompareIsNot => self::ValueCompareIsNot, 
		NGPropertyCriteria::CompareLike => self::ValueCompareLike, 
		NGPropertyCriteria::CompareNotLike => self::ValueCompareNotLike, 
		NGPropertyCriteria::CompareGreater => self::ValueCompareGreater, 
		NGPropertyCriteria::CompareSmaller => self::ValueCompareSmaller, 
		NGPropertyCriteria::CompareGreaterOrEqual => self::ValueCompareGreaterOrEqual, 
		NGPropertyCriteria::CompareSmallerOrEqual => self::ValueCompareSmallerOrEqual, 
		NGPropertyCriteria::CompareFulltext => self::ValueCompareFulltext 
	);
	
	/**
	 * 
	 * Converts value to compare
	 * @var array
	 */
	public static $valueToCompare = array (
		self::ValueCompareNone => NGPropertyCriteria::CompareNone, 
		self::ValueCompareIs => NGPropertyCriteria::CompareIs, 
		self::ValueCompareIsNot => NGPropertyCriteria::CompareIsNot, 
		self::ValueCompareLike => NGPropertyCriteria::CompareLike, 
		self::ValueCompareNotLike => NGPropertyCriteria::CompareNotLike, 
		self::ValueCompareGreater => NGPropertyCriteria::CompareGreater, 
		self::ValueCompareSmaller => NGPropertyCriteria::CompareSmaller, 
		self::ValueCompareGreaterOrEqual => NGPropertyCriteria::CompareGreaterOrEqual, 
		self::ValueCompareSmallerOrEqual => NGPropertyCriteria::CompareSmallerOrEqual, 
		self::ValueCompareFulltext => NGPropertyCriteria::CompareFulltext  
	);
	
		
	/**
	 * 
	 * Converts sort to value
	 * @var array
	 */
	public static $sortToValue = array (
		NGPropertyCriteria::SortNone => self::ValueSortNone, 
		NGPropertyCriteria::SortAsc => self::ValueSortAsc, 
		NGPropertyCriteria::SortDesc => self::ValueSortDesc 
	);
	
	/**
	 * 
	 * Converts value to sort
	 * @var array
	 */
	public static $valueToSort = array (
		self::ValueSortNone => NGPropertyCriteria::SortNone, 
		self::ValueSortAsc => NGPropertyCriteria::SortAsc, 
		self::ValueSortDesc => NGPropertyCriteria::SortDesc  
	);

	/**
	 * 
	 * Converts actions to values
	 * @var array
	 */
	public static $actionToValue = array (
		NGObject::ActionView => self::ValueActionView,
		NGObject::ActionModify => self::ValueActionModify,
		NGObject::ActionAdd => self::ValueActionAdd,
		NGObject::ActionDelete => self::ValueActionDelete,
		NGObject::ActionAdmin => self::ValueActionAdmin
	);

	/**
	 * 
	 * Converts values to actions
	 * @var array
	 */
	public static $valueToAction = array (
		self::ValueActionView  => NGObject::ActionView,
		self::ValueActionModify => NGObject::ActionModify,
		self::ValueActionAdd => NGObject::ActionAdd,
		self::ValueActionDelete => NGObject::ActionDelete,
		self::ValueActionAdmin => NGObject::ActionAdmin 
	);
		
	/**
	 * 
	 * Converts access to value
	 * @var array
	 */
	public static $accessToValue = array(
		NGObject::AccessDeny => self::ValueAccessDeny,
		NGObject::AccessOwner => self::ValueAccessOwner,
		NGObject::AccessOwnerGroup => self::ValueAccessOwnerGroup,
		NGObject::AccessAny => self::ValueAccessAny
	);

	/**
	 * 
	 * Converts value to access
	 * @var array
	 */
	public static $valueToAccess = array (
		self::ValueAccessDeny => NGObject::AccessDeny,
		self::ValueAccessOwner => NGObject::AccessOwner,
		self::ValueAccessOwnerGroup => NGObject::AccessOwnerGroup,
		self::ValueAccessAny => NGObject::AccessAny 
	);
			
	/**
	 * 
	 * To save objects
	 * @var NGDBAdapterObject
	 */
	public $objectAdapter;
	
	/* (non-PHPdoc)
	 * @see NGRest::__construct()
	 */
	public function __construct() {
		parent::__construct ();
		
		$this->objectAdapter = new NGDBAdapterObject ();
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::__destruct()
	 */
	public function __destruct() {
		unset ( $this->objectAdapter );
		parent::__destruct ();
	}
	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		
		foreach ( $this->requestDocument->documentElement->childNodes as $requestNode ) {
			
			/* @var $requestNode DOMElement */
			if ($requestNode->nodeType == XML_ELEMENT_NODE) {
				if ($requestNode->nodeName == self::NodeDomains) {
					$this->objectAdapter->domains = $this->loadDomains ( $requestNode );
				}
				if ($requestNode->nodeName == self::NodeLangs) {
					$this->objectAdapter->langs = $this->loadLangs($requestNode);
				}				
			}
		}
	}
	
	/**
	 * 
	 * Loads Domain Filter
	 * @param DOMElement $domainsNode Node to load from
	 */
	private function loadDomains(DOMElement $domainsNode) {
		$domains = array ();
		
		foreach ( $domainsNode->childNodes as $domainNode ) {
			/* @var $domainNode DOMElement */
			if ($domainNode->nodeType == XML_ELEMENT_NODE) {
				if ($domainNode->nodeName == self::NodeDomain) {
					$domain = $domainNode->nodeValue;
					$domains [] = $domain;
				}
			}
		}
		
		return $domains;
	}
	
	/**
	 * 
	 * Loads Language Filter
	 * @param DOMElement $langsNode Node to load from
	 */
	private function loadLangs(DOMElement $langsNode) {
		$langs = array ();
		
		foreach ( $langsNode->childNodes as $langNode ) {
			/* @var $langNode DOMElement */
			if ($langNode->nodeType == XML_ELEMENT_NODE) {
				if ($langNode->nodeName == self::NodeLang) {
					$domain = $langNode->nodeValue;
					$langs [] = $domain;
				}
			}
		}
		
		return $langs;
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loginRequired()
	 */
	function loginRequired() {
		return true;
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loginRequired()
	 */
	function connectionRequired() {
		return true;
	}
	
}