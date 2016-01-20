<?php 

namespace Gamebook\Entity;

class Game{

protected $title;
protected $imagePath;
protected $rating;

public function isRecomended($user){
	$compatible = $user->getGenreCompatibility($this->getGenderCode());
	return $this->getAvg()/10*$compatible >= 3;
}

public function getAvg(){
	$ratings = $this->getRating();
	$numRatings = count($ratings);
	
	if($numRatings == 0){
		return null;
	}
	$total = 0;
	foreach ($ratings as $value) {
		$score = $value->getScore();
		if($score === null){
			$numRatings--;
			continue;
		}
		$total += $score;
	}
	
	return $total/$numRatings;
	
}

public function __construct($title= "" ,$imagePath= "" ,$rating = 0){
$this->title = $title;
$this->imagePath = $imagePath;
$this->rating = $rating;

}

public function getTitle(){
return $this->title;
}

public function setTitle($title){
 $this->title=$title;
}

public function getImagePath(){
	if($this->imagePath == null){
		return "images/placeholder.jpg";
	}
return $this->imagePath;
}

public function setImagePath($imagePath){
 $this->imagePath=$imagePath;
}

public function getRating(){
return $this->rating;
}

public function setRating($rating){
 $this->rating=$rating;
}

}