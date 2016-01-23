<?php

namespace Gamebook\Entity;

class Game {
	protected $id;
	protected $title;
	protected $imagePath;
	protected $ratings;
	public function isRecomended($user) {
		$compatible = $user->getGenreCompatibility ( $this->getGenderCode () );
		return $this->getAvg () / 10 * $compatible >= 3;
	}
	public function getAvg() {
		$ratings = $this->getRatings ();
		$numRatings = count ( $ratings );
		
		if ($numRatings == 0) {
			return null;
		}
		$total = 0;
		foreach ( $ratings as $value ) {
			$score = $value->getScore ();
			if ($score === null) {
				if(count ( $ratings ) == 1){
					return null;
				}
				$numRatings --;
				continue;
			}
			$total += $score;
		}
		
		return $total / $numRatings;
	}
	public function __construct($id = 0, $title = "", $imagePath = "", $ratings = array()) {
		$this->id = $id;
		$this->title = $title;
		$this->imagePath = $imagePath;
		$this->ratings = $ratings;
	}
	public function getId() {
		return $this->id;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function getImagePath() {
		if ($this->imagePath == null) {
			return "images/placeholder.jpg";
		}
		return $this->imagePath;
	}
	public function setImagePath($imagePath) {
		$this->imagePath = $imagePath;
	}
	public function getRatings() {
		return $this->ratings;
	}
	public function setRatings($ratings) {
		$this->ratings = $ratings;
	}
}