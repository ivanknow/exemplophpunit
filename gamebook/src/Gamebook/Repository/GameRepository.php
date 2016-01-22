<?php

namespace Gamebook\Repository;

use Gamebook\Entity\Game;
use Gamebook\Entity\Rating;

class GameRepository{
	
	protected $pdo;
	
	public function __construct(){
	$this->pdo = new \PDO("mysql:host=localhost;dbname=game","root",null);
	
	}
	
	public function findById($id) {
		$sta = $this->pdo->prepare('SELECT * FROM game WHERE id=?');
		$sta->execute([$id]);
		$game = $sta->fetchObject('Gamebook\Entity\Game');
		return $game;
	}
	
	public function saveGameRating($game_id,$user_id,$score) {
		$sta = $this->pdo->prepare('replace into rating (game_id,user_id,score) values (?,?,?)');
		return $sta->execute([$game_id,$user_id,$score]);
	}
	
	public function findByUSerId($id){
		$games = [];
		for($i = 0;$i<6;$i++){
			$game = new Game($i);
			$game->setTitle("Game .".$i);
			$game->setImagePath("images/game.jpg");
			$rating = new Rating();
			$rating->setScore(4.5);
			$game->setRatings([$rating]);
			$games[] = $game;
		}
		return $games;
	}
}
?>