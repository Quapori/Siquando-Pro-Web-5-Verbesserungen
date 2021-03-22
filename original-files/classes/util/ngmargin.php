<?php

class NGMargin {
	public $all = 0;
	public $top = - 1;
	public $right = - 1;
	public $bottom = - 1;
	public $left = - 1;
	
	public function individualMargins() {
		return ($this->all === - 1);
	}
	
	public function totalWidth() {
		if ($this->individualMargins ()) {
			return $this->left + $this->right;
		} else {
			return $this->all * 2;
		}
	}
	
	public function totalHeight() {
		if ($this->individualMargins ()) {
			return $this->top + $this->bottom;
		} else {
			return $this->all * 2;
		}
	}

    /**
     * @return int Get the top
     */
	public function getTop() {
	    return $this->individualMargins() ? $this->top : $this->all;
    }

    /**
     * @return int get left
     */
    public function getLeft() {
        return $this->individualMargins() ? $this->left : $this->all;
    }

    /**
     * @return int get bottom
     */
    public function getBottom() {
        return $this->individualMargins() ? $this->bottom : $this->all;
    }

    /**
     * @return int get right
     */
    public function getRight() {
        return $this->individualMargins() ? $this->right : $this->all;
    }


    /**
     * Adds two margins
     *
     * @param $margin
     * @return NGMargin
     */
    public function addMargin($margin) {
	    $result = new NGMargin('');

	    $result->all = -1;
	    $result->top = $this->getTop() + $margin->getTop();
        $result->bottom = $this->getBottom() + $margin->getBottom();
        $result->left = $this->getLeft() + $margin->getLeft();
        $result->right = $this->getRight() + $margin->getRight();

        return $result;
    }

    /**
     * @return string
     */
    public function toCSSString() {
        if ($this->individualMargins()) {
            return sprintf('%spx %spx %spx %spx', $this->top, $this->right, $this->bottom, $this->left);
        } else {
            return spring ('%spx', $this->all);
        }
    }


    public function __construct($data) {
		$parts = explode ( ' ', $data );
		
		switch (count ( $parts )) {
			case 1 :
				$this->all = $parts [0];
				$this->top = - 1;
				$this->right = - 1;
				$this->bottom = - 1;
				$this->left = - 1;
				break;
			case 4 :
				$this->all = - 1;
				$this->top = $parts [0];
				$this->right = $parts [1];
				$this->bottom = $parts [2];
				$this->left = $parts [3];
				break;
			default :
				$this->all = 0;
				$this->top = - 1;
				$this->right = - 1;
				$this->bottom = - 1;
				$this->left = - 1;
				break;
		}
	}
}