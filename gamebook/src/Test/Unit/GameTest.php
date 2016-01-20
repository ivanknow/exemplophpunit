<?php
$loader = require __DIR__ . '/../../../vendor/autoload.php';

use Gamebook\Entity\Game;

class GameTest extends PHPUnit_Framework_TestCase{

	public function testImage_WithNull_ReturnPlaceholder() {
		$game = new Game();
		$this->assertEquals('images/placeholder.jpg',$game->getImagePath());
	}
	
	public function testImage_WithPath_ReturnPath() {
		$game = new Game();
		$game->setImagePath("/images/game.jpg");
		$this->assertEquals('/images/game.jpg',$game->getImagePath());
	}

	public function testIsRecomended_with5_ReturnTrue() {
		$game = $this->getMock('Gamebook\Entity\Game',['getAvg']);
		$game->method('getAvg')->willReturn(5);
		$this->assertTrue($game->isRecomended());
	}
}