<?php
class NGPluginParagraphCalendarView extends NGPluginParagraph {
	const ObjectTypePluginParagraphCalendarView = 'NGPluginParagraphCalendarView';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphCalendarView = 'paragraphcalendarview';
	
	/**
	 *
	 * UID of linkes calendar
	 * 
	 * @var string
	 */
	public $calendaruid = '';
	
	/**
	 *
	 * Columns
	 * 
	 * @var int
	 */
	public $columns = 2;
	
	/**
	 *
	 * Rows
	 * 
	 * @var int
	 */
	public $rows = 1;
	
	/**
	 *
	 * Year
	 * 
	 * @var int
	 */
	public $year = - 1;
	
	/**
	 *
	 * Month
	 * 
	 * @var int
	 */
	public $month = - 1;
	
	/**
	 *
	 * Days
	 * 
	 * @var int
	 */
	public $days = - 1;
	
	/**
	 *
	 * Compact view
	 * 
	 * @var bool
	 */
	public $compact = true;
	
	/**
	 *
	 * Big pictures
	 * 
	 * @var bool
	 */
	public $bigpictures = true;
	
	/**
	 *
	 * Filter by category
	 * 
	 * @var string
	 */
	public $categories = '';
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'calendaruid', NGProperty::TypeUID, self::DomainParagraphCalendarView, 'calendaruid', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'columns', NGProperty::TypeInt, self::DomainParagraphCalendarView, 'columns', NGPropertyMapped::MultiplicityScalar, false, 2 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rows', NGProperty::TypeInt, self::DomainParagraphCalendarView, 'rows', NGPropertyMapped::MultiplicityScalar, false, 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'year', NGProperty::TypeInt, self::DomainParagraphCalendarView, 'year', NGPropertyMapped::MultiplicityScalar, false, - 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'month', NGProperty::TypeInt, self::DomainParagraphCalendarView, 'month', NGPropertyMapped::MultiplicityScalar, false, - 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'days', NGProperty::TypeInt, self::DomainParagraphCalendarView, 'days', NGPropertyMapped::MultiplicityScalar, false, - 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bigpictures', NGProperty::TypeBool, self::DomainParagraphCalendarView, 'bigpictures', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'compact', NGProperty::TypeBool, self::DomainParagraphCalendarView, 'compact', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'categories', NGProperty::TypeString, self::DomainParagraphCalendarView, 'categories', NGPropertyMapped::MultiplicityScalar, false, '' );
	}
	public function render() {
		if ($this->calendaruid !== '') {
			
			$adapter = new NGDBAdapterObject ();
			
			/* @var $calendar NGPluginParagraphCalendar */
			$calendar = $adapter->loadObject ( $this->calendaruid, NGPluginParagraph::ObjectTypePluginParagraph, NGPluginParagraph::ObjectTypePluginParagraph );
			
			if ($calendar !== null) {
				
				$calendar->renderWidth = $this->renderWidth;
				$calendar->currentPage = $this->currentPage;
				$calendar->previewMode = $this->previewMode;
				$calendar->columns = $this->columns;
				$calendar->rows = $this->rows;
				$calendar->year = $this->year;
				$calendar->month = $this->month;
				$calendar->days = $this->days;
				$calendar->bigpictures = $this->bigpictures;
				$calendar->compact = $this->compact;
				$calendar->categories = $this->categories;
				$calendar->responsive = $this->responsive;
				
				$calendar->render ();
				$this->output = $calendar->output;
				$this->styleSheets = $calendar->styleSheets;
				$this->styles = $calendar->styles;
				$this->javaScripts = $calendar->javaScripts;
				$this->dontCache = $calendar->dontCache;
				$this->keywords = $calendar->keywords;
				$this->nextScheduledChange = $calendar->nextScheduledChange;
			}
		}
	}
	public function __construct() {
		parent::__construct ();
	}
}