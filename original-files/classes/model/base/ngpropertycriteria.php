<?php

class NGPropertyCriteria extends NGProperty {
	const CompareNone = NGDBQPartCriteriaWhere::CompareNone;
    const CompareIs = NGDBQPartCriteriaWhere::CompareIs;
	const CompareIsNot = NGDBQPartCriteriaWhere::CompareIsNot;
	const CompareLike = NGDBQPartCriteriaWhere::CompareLike;
	const CompareNotLike = NGDBQPartCriteriaWhere::CompareNotLike;
	const CompareGreater = NGDBQPartCriteriaWhere::CompareGreater;
	const CompareSmaller = NGDBQPartCriteriaWhere::CompareSmaller;
	const CompareGreaterOrEqual = NGDBQPartCriteriaWhere::CompareGreaterOrEqual;
	const CompareSmallerOrEqual = NGDBQPartCriteriaWhere::CompareSmallerOrEqual;
	const CompareFulltext = NGDBQPartCriteriaWhere::CompareFulltext;
	
	const SortNone=0;
	const SortAsc=1;
	const SortDesc=2;
		
	public $output=false;
	public $compare=self::CompareNone;
	public $sort=self::SortNone;
	
	/**
	 * 
	 * Enter description here ...
     * @param string $name Name of property
     * @param string $name Index Kex, if indexed property
     * @param int $type Type
     * @param mixed $value Value to comapre
     * @param boolean $output Should the property be in output
	 * @param int $compare Should the query compare by this property
	 * @param int $sort Should the query sort by this proeprty
     * @param string $domain Domain of property
     * @param string $lang Language of property
	 */
	public function __construct($name, $type, $value, $output, $compare, $sort, $lang=NGUtil::LanguageNeutral, $domain=NGUtil::DomainCore, $index='') {
		parent::__construct($name, $type, $value, $lang, $domain);
		$this->output=$output;
		$this->compare=$compare;
		$this->sort=$sort;
		$this->index=$index;
	}
}