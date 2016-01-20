<?php

namespace Gamebook\Repository;

use Gamebook\Entity\Game;

class GameRepository{
	
	public function findByUSerId($id){
		$games = [];
		for($i = 0;$i<6;$i++){
			$game = new Game();
			$game->setTitle("Game .".$i);
			$game->setImagePath("images/game.jpg");
			$game->setRating(4.5);
			$games[] = $game;
		}
		return $games;
	}
}
?>