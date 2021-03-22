<?php

class NGPluginParagraphCalendar extends NGPluginParagraph {
	const ObjectTypePluginParagraphCalendar = 'NGPluginParagraphCalendar';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphCalendar = "paragraphcalendar";

	/**
	 *
	 * Rich text renderer
	 *
	 * @var NGRichText
	 */
	private $richText;

	/**
	 *
	 * Language resources
	 *
	 * @var NGLanguageAdapter
	 */
	private $lang;

	/**
	 *
	 * Array of calndar events
	 *
	 * @var array
	 */
	private $calendarEvents;

	/**
	 *
	 * List of events
	 *
	 * @var array
	 */
	public $events;

	/**
	 *
	 * List of captions
	 *
	 * @var array
	 */
	public $captions;

	/**
	 *
	 * List of summaries
	 *
	 * @var array
	 */
	public $summaries;

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
	 * Categories
	 *
	 * @var unknown_type
	 */
	public $categories = '';

	/**
	 *
	 * resoruce ids of months
	 *
	 * @var array
	 */
	private $monthIds = array (
			'january',
			'february',
			'march',
			'april',
			'may',
			'june',
			'july',
			'august',
			'september',
			'october',
			'november',
			'december' 
	);

	/**
	 *
	 * ressource ids of weekday
	 *
	 * @var array
	 */
	private $weekdayIds = array (
			'mon',
			'tue',
			'wed',
			'thu',
			'fri',
			'sat',
			'sun' 
	);

	/**
	 *
	 * Color Code styles
	 *
	 * @var array
	 */
	private $colorCodeStyles = array (
			1 => 'green',
			2 => 'orange',
			3 => 'red',
			4 => '' 
	);

	/**
	 *
	 * Used events
	 *
	 * @var array
	 */
	private $usedEvents = array ();

	/**
	 *
	 * Database adapter
	 *
	 * @var NGDBAdapterObject
	 */
	private $adapter;

	/**
	 * Width of table
	 *
	 * @var int
	 */
	private $tableWidth;

	/**
	 *
	 * Gutter between tables
	 *
	 * @var int
	 */
	private $gutter = 10;

	/**
	 *
	 * ClearFix Tag
	 *
	 * @var NGRenderTag
	 */
	private $tagClearFix;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'events', NGProperty::TypeText, self::DomainParagraphCalendar, 'events', NGPropertyMapped::MultiplicityDictornary, false, Array () );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captions', NGProperty::TypeString, self::DomainParagraphCalendar, 'captions', NGPropertyMapped::MultiplicityDictornary, true, Array () );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'summaries', NGProperty::TypeFulltext, self::DomainParagraphCalendar, 'summaries', NGPropertyMapped::MultiplicityDictornary, true, Array () );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'columns', NGProperty::TypeInt, self::DomainParagraphCalendar, 'columns', NGPropertyMapped::MultiplicityScalar, false, 2 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rows', NGProperty::TypeInt, self::DomainParagraphCalendar, 'rows', NGPropertyMapped::MultiplicityScalar, false, 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'year', NGProperty::TypeInt, self::DomainParagraphCalendar, 'year', NGPropertyMapped::MultiplicityScalar, false, - 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'month', NGProperty::TypeInt, self::DomainParagraphCalendar, 'month', NGPropertyMapped::MultiplicityScalar, false, - 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'days', NGProperty::TypeInt, self::DomainParagraphCalendar, 'days', NGPropertyMapped::MultiplicityScalar, false, - 1 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bigpictures', NGProperty::TypeBool, self::DomainParagraphCalendar, 'bigpictures', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'compact', NGProperty::TypeBool, self::DomainParagraphCalendar, 'compact', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'categories', NGProperty::TypeString, self::DomainParagraphCalendar, 'categories', NGPropertyMapped::MultiplicityScalar, false, '' );
	}

	/**
	 * Render paragraph
	 *
	 * @see NGPluginParagraph::render()
	 */
	public function render() {
		$this->richText->previewMode = $this->previewMode;
		
		$this->adapter = new NGDBAdapterObject ();
		
		$this->lang = new NGLanguageAdapter ();
		$this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphcalendar/language/langcalendar.xml';
		$this->lang->load ();
		
		$this->calendarEvents = array ();
		
		foreach ( $this->events as $id => $data ) {
			$calendarEvent = new CalendarEvent ( $id, $data );
			
			if (array_key_exists ( $id, $this->captions ))
				$calendarEvent->caption = $this->captions [$id];
			if (array_key_exists ( $id, $this->summaries ))
				$calendarEvent->summary = $this->summaries [$id];
			
			if (strpos ( $this->categories, $calendarEvent->category ) === false)
				$this->calendarEvents [] = $calendarEvent;
		}
		
		uasort ( $this->calendarEvents, array (
				'self',
				'sortByTime' 
		) );
		
		$this->tagClearfix = new NGRenderTag ( 'div' );
		$this->tagClearfix->class = 'clearfix';
		
		$tagContainer = new NGRenderTag ( 'div' );
		$tagContainer->class = 'paragraphcalendar';
		
		$today = NGSession::getInstance ()->callTimestamp;
		
		if ($this->days == - 1) {
			$this->renderCalendars ( $tagContainer );
		} else {
			$this->renderList ( $tagContainer );
		}
		
		$this->output = $tagContainer->render ();
		
		$this->styleSheets ['NGPluginParagraphCalendar'] = $this->prependPluginsPath ( 'ngpluginparagraphcalendar/css/' );
		$this->javaScripts ['NGPluginParagraphCalendar'] = $this->prependPluginsPath ( 'ngpluginparagraphcalendar/js/calendar.js' );
	}

	/**
	 *
	 * Render as list
	 *
	 * @param NGRenderTag $parentTag        	
	 */
	private function renderList(NGRenderTag $parentTag) {
		$year = $this->year;
		$month = $this->month;
		$day = 1;
		
		$oneDay = new DateInterval ( 'P1D' );
		
		if ($year == - 1) {
			$now = new DateTime ( '@' . NGSession::getInstance ()->callTimestamp );
			$year = intval ( $now->format ( 'Y' ) );
			$month = intval ( $now->format ( 'n' ) );
			$day = intval ( $now->format ( 'd' ) );
			
			$next = new DateTime ( sprintf ( '%04d-%02d-%02d', $year, $month, $day ) );
			$next->add ( $oneDay );
			
			$this->nextScheduledChange = $next->format ( DATE_ATOM );
		}
		
		$date = $this->getDate ( $day, $month, $year );
		
		for($i = 0; $i < $this->days; $i ++) {
			$this->renderListEntry ( $parentTag, $date );
			$date->add ( $oneDay );
		}
	}

	/**
	 *
	 * Render one list entry
	 *
	 * @param NGRenderTag $parentTag        	
	 * @param DateTime $date        	
	 */
	private function renderListEntry(NGRenderTag $parentTag, DateTime $date) {
		$events = array ();
		
		/* @var $event CalendarEvent */
		foreach ( $this->calendarEvents as $event ) {
			if ($event->isVisibleOn ( $date ) && $event->caption != '') {
				$events [] = $event;
			}
		}
		
		if (count ( $events ) > 0) {
			
			$div = new NGRenderTag ( 'div' );
			$div->class = 'paragraphcalenderevents';
			
			if (! $this->compact) {
				$marquee = new NGRenderTag ( 'div' );
				$marquee->class = 'paragraphcalendermarquee';
				$marquee->content = $date->format ( 'd.m' ) . '<br>' . $date->format ( 'Y' );
				$div->content .= $marquee->render ();
			}
			
			foreach ( $events as $event ) {
				$this->createEventInfo ( $div, $event, $this->compact ? $date : null );
			}
			
			$parentTag->content .= $div->render ();
		}
	}

	/**
	 *
	 * Render all calendars
	 *
	 * @param NGRenderTag $parentTag        	
	 */
	private function renderCalendars(NGRenderTag $parentTag) {
		$tagEvents = new NGRenderTag ( 'div' );
		$tagEvents->class = 'paragraphcalenderevents';
		
		$year = $this->year;
		$month = $this->month;
		
		if ($year == - 1) {
			$now = new DateTime ( '@' . NGSession::getInstance ()->callTimestamp );
			$year = intval ( $now->format ( 'Y' ) );
			$month = intval ( $now->format ( 'n' ) );
			
			$nextmonth = $month + 1;
			$nextyear = $year;
			
			if ($nextmonth > 12) {
				$nextmonth = 1;
				$nextyear ++;
			}
			
			$next = new DateTime ( sprintf ( '%04d-%02d-01', $nextyear, $nextmonth ) );
			
			$this->nextScheduledChange = $next->format ( DATE_ATOM );
		}
		
		$this->tableWidth = ($this->renderWidth - $this->gutter * ($this->columns - 1)) / $this->columns;
		
		for($row = 0; $row < $this->rows; $row ++) {
			$tagDiv = new NGRenderTag ( 'div' );
			
			if ($this->responsive) {
				$tagDiv->class = 'paragraphcalendar' . $this->columns . 'cols';
			}
			
			for($col = 0; $col < $this->columns; $col ++) {
				$this->renderCalendar ( $month, $year, ($col == $this->columns - 1), $tagDiv );
				$month ++;
				if ($month > 12) {
					$month = 1;
					$year ++;
				}
			}
			$tagDiv->content .= $this->tagClearfix->render ();
			$tagDiv->content .= $tagEvents->render ();
			$parentTag->content .= $tagDiv->render ();
		}
		
		$this->renderEventList ( $parentTag );
	}

	/**
	 *
	 * Mark an event as used in calendars
	 *
	 * @param CalendarEvent $event        	
	 */
	private function markUsedEvent(CalendarEvent $event) {
		if (! array_key_exists ( $event->id, $this->usedEvents ))
			$this->usedEvents [$event->id] = $event;
	}

	/**
	 *
	 * Render the event list repo
	 *
	 * @param NGRenderTag $parentTag        	
	 */
	private function renderEventList(NGRenderTag $parentTag) {
		$tagEventInfo = new NGRenderTag ( 'div' );
		$tagEventInfo->class = 'paragraphcalendareventinfo';
		
		foreach ( $this->usedEvents as $id => $event ) {
			$this->createEventInfo ( $tagEventInfo, $event );
		}
		
		$parentTag->content .= $tagEventInfo->render ();
	}

	/**
	 *
	 * Custom sort
	 *
	 * @param CalendarEvent $a        	
	 * @param CalendarEvent $b        	
	 */
	private static function sortByTime(CalendarEvent $a, CalendarEvent $b) {
		if ($a->startTime === $b->startTime)
			return 0;
		
		return ($a->startTime < $b->startTime) ? - 1 : 1;
	}

	/**
	 *
	 * Create an event Info
	 *
	 * @param NGRenderTag $parentTag        	
	 * @param unknown_type $event        	
	 * @param DateTime $date        	
	 */
	private function createEventInfo(NGRenderTag $parentTag, CalendarEvent $event, DateTime $date = null) {
		$div = new NGRenderTag ( 'div' );
		$div->id = 'paragraphcalenderevent' . $event->id;
		$h3 = new NGRenderTag ( 'h3' );
		
		$time = '';
		
		if ($event->getStartTime () !== '')
			$time = $event->getStartTime () . ' ';
		if ($event->getEndTime () !== '')
			$time .= '- ' . $event->getEndTime () . ' ';
		
		$h3->content = htmlspecialchars ( $time .= $event->caption );
		
		if ($date !== null)
			$h3->content = $date->format ( NGConfig::DateFormatLocal ) . ': ' . $h3->content;
		
		$div->content .= $h3->render ();
		
		$a = null;
		
		if ($event->link !== '') {
			$link = new NGLink ( $this->previewMode );
			$a = new NGRenderA ();
			
			$link->parseURL ( $event->link );
			
			$a->href = $link->getURL ();
			
			switch ($link->linkType) {
				case NGLink::LinkPicture :
					$a->class = 'gallery';
					break;
				case NGLink::LinkPagePopup :
				case NGLink::LinkTopicPopup :
					$a->class = 'galleryiframe';
					break;
				case NGLink::LinkWWW :
					$a->attributes ['target'] = '_blank';
					break;
			}
		}
		
		if ($event->pictureUid !== '') {
			
			/* @var $picture NGPicture */
			$picture = $this->adapter->loadObject ( $event->pictureUid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
			
			if ($picture != null) {
				
				$width = $this->bigpictures ? $this->renderWidth : floor ( $this->renderWidth / 3 );
				
				if ($this->responsive) {
					if ($width < 768)
						$width = 768;
				}
				
				/* @var $size NGSize */
				$size = $picture->getResizedSize ( $width );
				
				$img = new NGRenderTag ( 'img' );
				$img->singleTag = true;
				
				if ($this->responsive) {
					$img->attributes ['width'] = $size->width;
					$img->attributes ['height'] = $size->height;
				} else {
					$img->style->selectors ['width'] = $size->width . 'px';
					$img->style->selectors ['height'] = $size->height . 'px';
				}
				
				if (! $this->bigpictures)
					$img->class = 'paragraphcalendarsidepicture';
				
				if (NGSettingsSite::getInstance ()->lazyload) {
					$img->class .= ' nglazyload';
					$img->attributes ['data-src'] = NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height );
					
					if (NGSettingsSite::getInstance ()->hdpictures) {
						$img->attributes ['data-src-hd'] = NGLink::getPictureURL ( $picture->objectUID, $size->width * 2, $size->height * 2 );
					}
				} else {
					$img->attributes ['src'] = NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height );
				}
				
				$img->attributes ['alt'] = $picture->displayAlt ();
				
				if ($a !== null) {
					$a->content = $img->render ();
					$div->content .= $a->render ();
				} else {
					$div->content .= $img->render ();
				}
			}
		}
		
		$div->content .= $this->richText->parse ( $event->summary );
		
		if ($a !== null) {
			$a->content = htmlspecialchars ( $this->lang->languageResources ['more']->value );
			
			$p = new NGRenderTag ( 'p' );
			$p->style->selectors ['text-align'] = 'right';
			$p->content = $a->render ();
			
			$div->content .= $p->render ();
		}
		
		if (! $this->bigpictures) {
			$div->content .= $this->tagClearfix->render ();
		}
		
		$parentTag->content .= $div->render ();
	}

	/**
	 *
	 * Render a calendar
	 *
	 * @param int $month        	
	 * @param int $year        	
	 * @param int $lastCol        	
	 * @param NGRenderTag $parentTag        	
	 */
	private function renderCalendar($month, $year, $lastCol, NGRenderTag $parentTag) {
		$tagTable = new NGRenderTag ( 'table' );
		
		if (! $this->responsive) {
			$tagTable->style->selectors ['width'] = $this->tableWidth . 'px';
			$tagTable->style->selectors ['margin-bottom'] = $this->gutter . 'px';
		}
		$tagTable->attributes ['data-year'] = $year;
		$tagTable->attributes ['data-month'] = $month;
		
		if (! $this->responsive) {
			if (! $lastCol)
				$tagTable->style->selectors ['margin-right'] = $this->gutter . 'px';
		}
		
		$tagThead = new NGRenderTag ( 'thead' );
		$tagTbody = new NGRenderTag ( 'tbody' );
		
		$this->renderCalendarHeader ( $month, $year, $tagThead );
		$this->renderCalendarWeekdays ( $tagThead );
		$tagTbody->content .= $this->renderCalendarDays ( $month, $year, $tagTbody );
		$tagTable->content .= $tagThead->render ();
		$tagTable->content .= $tagTbody->render ();
		
		$parentTag->content .= $tagTable->render ();
	}

	/**
	 *
	 * Render all days in calendar
	 *
	 * @param int $month        	
	 * @param int $year        	
	 * @param NGRenderTag $parentTag        	
	 */
	private function renderCalendarDays($month, $year, NGRenderTag $parentTag) {
		$weekday = (intval ( self::getDate ( 1, $month, $year )->format ( 'w' ) ) + 6) % 7;
		$days = intval ( self::getDate ( 1, $month, $year )->format ( 't' ) );
		
		$day = - 1;
		
		for($row = 0; $row < 6; $row ++) {
			$tagTr = new NGRenderTag ( 'tr' );
			for($col = 0; $col < 7; $col ++) {
				if ($day == - 1) {
					if ($col == $weekday)
						$day = 1;
				}
				
				$tagTd = new NGRenderTag ( 'td' );
				
				if ($day != - 1 && $day <= $days) {
					$tagTd->content = $day;
					
					$date = self::getDate ( $day, $month, $year );
					
					$ids = array ();
					$captions = array ();
					
					$colorCode = 0;
					
					/* @var $calendarEvent CalendarEvent */
					foreach ( $this->calendarEvents as $calendarEvent ) {
						if ($calendarEvent->isVisibleOn ( $date )) {
							
							$colorCode = max ( $colorCode, $calendarEvent->colorCode );
							
							if ($calendarEvent->caption != '') {
								$this->markUsedEvent ( $calendarEvent );
								if (! in_array ( $calendarEvent->id, $ids ))
									$ids [] = $calendarEvent->id;
								$tagTd->class = 'calendarclickable';
								$captions [] = $calendarEvent->caption;
							}
						}
					}
					
					if ($colorCode > 0) {
						
						$tagTd->class .= ' calendarevent' . $this->colorCodeStyles [$colorCode];
						
						if (count ( $captions ) > 0)
							$tagTd->attributes ['title'] = join ( ', ', $captions );
						
						if (count ( $ids ) > 0)
							$tagTd->attributes ['data-ids'] = join ( ' ', $ids );
					}
					
					$day ++;
				} else {
					$tagTd->content = '&nbsp;';
					$tagTd->class = 'emptycalendercell';
				}
				
				$tagTr->content .= $tagTd->render ();
			}
			$parentTag->content .= $tagTr->render ();
		}
	}

	/**
	 *
	 * Get a day
	 *
	 * @param unknown_type $day        	
	 * @param unknown_type $month        	
	 * @param unknown_type $year        	
	 */
	public static function getDate($day, $month, $year) {
		return new DateTime ( sprintf ( '%s-%s-%s', $year, $month, $day ) );
	}

	/**
	 *
	 * Render the header
	 *
	 * @param unknown_type $month        	
	 * @param unknown_type $year        	
	 * @param NGRenderTag $parentTag        	
	 */
	private function renderCalendarHeader($month, $year, NGRenderTag $parentTag) {
		$tagTr = new NGRenderTag ( 'tr' );
		$tagTd = new NGRenderTag ( 'th' );
		$tagTd->attributes ['colspan'] = '7';
		$tagTd->content = $this->niceDate ( $month, $year );
		$tagTr->content = $tagTd->render ();
		$parentTag->content .= $tagTr->render ();
	}

	/**
	 *
	 * Nice date
	 *
	 * @param unknown_type $month        	
	 * @param unknown_type $year        	
	 */
	private function niceDate($month, $year) {
		return $this->niceMonth ( $month ) . ' ' . $year;
	}

	/**
	 *
	 * Nice month
	 *
	 * @param unknown_type $month        	
	 */
	private function niceMonth($month) {
		return htmlspecialchars ( $this->lang->languageResources [$this->monthIds [$month - 1]]->value );
	}

	/**
	 *
	 * Render the weekdays
	 *
	 * @param NGRenderTag $parentTag        	
	 */
	private function renderCalendarWeekdays(NGRenderTag $parentTag) {
		$tagTr = new NGRenderTag ( 'tr' );
		$tagTd = new NGRenderTag ( 'th' );
		
		for($i = 0; $i < 7; $i ++) {
			$tagTd->content = $this->niceWeekday ( $i );
			$tagTr->content .= $tagTd->render ();
		}
		
		$parentTag->content .= $tagTr->render ();
	}

	/**
	 *
	 * Get nice weekday
	 *
	 * @param unknown_type $weekday        	
	 */
	private function niceWeekday($weekday) {
		return htmlspecialchars ( $this->lang->languageResources [$this->weekdayIds [$weekday]]->value );
	}

	public function __construct() {
		parent::__construct ();
		$this->richText = new NGRichText ();
	}
}

/**
 *
 * An event
 *
 * @author tom
 *        
 */
class CalendarEvent {
	const Separator = '|';
	const EventTypeSingle = 0;
	const EventTypeMultiple = 1;
	const EventTypeRepeat = 2;

	public $id;

	public $caption;

	public $eventtype;

	public $startDate;

	public $endDate;

	public $dates;

	public $summary;

	public $pictureUid;

	public $link;

	public $colorCode;

	public $weekDays;

	public $offset;

	public $startTime = '';

	public $endTime = '';

	public $category = '-';

	private static function parseDate($data) {
		$year = intval ( substr ( $data, 0, 4 ) );
		$month = intval ( substr ( $data, 4, 2 ) );
		$day = intval ( substr ( $data, 6, 2 ) );
		
		return NGPluginParagraphCalendar::getDate ( $day, $month, $year );
	}

	private static function parseWeekdays($data) {
		$result = array ();
		
		$parts = str_split ( $data );
		
		foreach ( $parts as $part ) {
			$result [] = intval ( $part );
		}
		
		return $result;
	}

	private static function formatTime($time) {
		if ($time === '') {
			return '';
		} else {
			return substr ( $time, 0, 2 ) . ':' . substr ( $time, 2, 2 );
		}
	}

	public function getStartTime() {
		return self::formatTime ( $this->startTime );
	}

	public function getEndTime() {
		return self::formatTime ( $this->endTime );
	}

	public function __construct($id, $data) {
		$this->id = $id;
		
		$parts = explode ( self::Separator, $data );
		
		if (strpos ( $parts [0], '-' ) > 0) {
			$subparts = explode ( '-', $parts [0] );
			
			if (count ( $subparts ) > 0)
				$this->startDate = self::parseDate ( $subparts [0] );
			
			if (count ( $subparts ) > 1)
				$this->endDate = self::parseDate ( $subparts [1] );
			
			if (count ( $subparts ) > 2) {
				$offset = intval ( $subparts [2] );
				if ($offset > 1)
					$this->offset = $offset;
			}
			
			$this->eventtype = self::EventTypeRepeat;
		} else if (strpos ( $parts [0], ' ' ) > 0) {
			
			$datestrings = explode ( ' ', $parts [0] );
			$this->dates = array ();
			
			foreach ( $datestrings as $datestring ) {
				$this->dates [] = self::parseDate ( $datestring );
			}
			
			$this->eventtype = self::EventTypeMultiple;
		} else {
			$this->startDate = self::parseDate ( $parts [0] );
			$this->eventtype = self::EventTypeSingle;
		}
		
		if (count ( $parts ) > 1)
			$this->pictureUid = $parts [1];
		if (count ( $parts ) > 2)
			$this->link = $parts [2];
		if (count ( $parts ) > 3)
			$this->colorCode = $parts [3];
		if (count ( $parts ) > 4) {
			if ($parts [4] !== '') {
				$this->weekDays = self::parseWeekdays ( $parts [4] );
			}
		}
		if (count ( $parts ) > 5)
			$this->startTime = $parts [5];
		if (count ( $parts ) > 6)
			$this->endTime = $parts [6];
		if (count ( $parts ) > 7)
			$this->category = $parts [7];
	}

	/**
	 *
	 * Is it visible?
	 *
	 * @param unknown_type $dateToCompare        	
	 */
	public function isVisibleOn($dateToCompare) {
		switch ($this->eventtype) {
			case self::EventTypeSingle :
				return ($this->startDate == $dateToCompare);
			case self::EventTypeMultiple :
				return in_array ( $dateToCompare, $this->dates );
			case self::EventTypeRepeat :
				if ($dateToCompare < $this->startDate)
					return false;
				if ($dateToCompare > $this->endDate)
					return false;
				
				if (isset ( $this->weekDays )) {
					$weekday = intval ( $dateToCompare->format ( 'w' ) );
					if (in_array ( $weekday, $this->weekDays ))
						return false;
				}
				
				if (isset ( $this->offset )) {
					$diff = $this->startDate->diff ( $dateToCompare );
					if ($diff->days % $this->offset != 0)
						return false;
				}
				return true;
		}
		return false;
	}
}