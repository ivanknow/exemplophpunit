<?php 

namespace Gamebook\Entity;


class Rating{

	private $game;
	private $user;
	private $score;
	public function __construct($game= null,$user= null,$score= null){
		$this->game = $game;
		$this->user = $user;
		$this->score = $score;

	}

	public function getGame(){
		return $this->game;
	}

	public function setGame($game){
		$this->game=$game;
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user=$user;
	}

	public function getScore(){
		return $this->score;
	}

	public function setScore($score){
		$this->score=$score;
	}

}