<?php 

namespace Gamebook\Entity;

class Game{

protected $title;
protected $imagePath;
protected $rating;

public function isRecomended(){
	return $this->getAvg() >= 3;
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