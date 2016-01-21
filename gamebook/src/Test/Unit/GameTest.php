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

/*nao eh mais relevante
 * 	public function testIsRecomended_with5_ReturnTrue() {
		$game = $this->getMock('Gamebook\Entity\Game',['getAvg']);
		$game->method('getAvg')->willReturn(5);
		$this->assertTrue($game->isRecomended());
	}*/
	
	public function testAvarageScore_WithoutRatings_ReturnNull() {
		$game = new Game();
		$game->setRatings([]);
		$this->assertNull($game->getAvg());
	}
	
	public function testAvarageScore_With6and8Ratings_Return7() {
		$r1 = $this->getMock('Rating',['getScore']);
		$r1->method('getScore')->willReturn(6);
		
		$r2 = $this->getMock('Rating',['getScore']);
		$r2->method('getScore')->willReturn(8);
		
		$game = new Game();
		$game->setRatings([$r1,$r2]);
		$this->assertEquals(7,$game->getAvg());
	}
	
	public function testAvarageScore_With5andNullRatings_Return7() {
		$r1 = $this->getMock('Rating',['getScore']);
		$r1->method('getScore')->willReturn(null);
	
		$r2 = $this->getMock('Rating',['getScore']);
		$r2->method('getScore')->willReturn(5);
	
		$game = new Game();
		$game->setRatings([$r1,$r2]);
		$this->assertEquals(5,$game->getAvg());
	}
	
	public function testAvarageScore_With5_Return5() {
		$r1 = $this->getMock('Rating',['getScore']);
		$r1->method('getScore')->willReturn(5);

	
		$game = new Game();
		$game->setRatings([$r1]);
		$this->assertEquals(5,$game->getAvg());
	}
	
	public function testAvarageScore_WithNull_ReturnNull() {
		$r1 = $this->getMock('Rating',['getScore']);
		$r1->method('getScore')->willReturn(null);
	
	
		$game = new Game();
		$game->setRatings([$r1]);
		$this->assertEquals(null,$game->getAvg());
	}
	
	public function testIsRecomendable_With2Compatibilityand10Ratings_ReturnFalse() {
		$game = $this->getMock('Gamebook\Entity\Game',['getAvg','getGenderCode']);
		$game->method('getAvg')->willReturn(10);
		
	
		$user = $this->getMock('User',['getGenreCompatibility']);
		$user->method('getGenreCompatibility')->willReturn(2);
	
		
		$this->assertFalse($game->isRecomended($user));
	}
	
	public function testIsRecomendable_With10Compatibilityand10Ratings_ReturnTrue() {
		$game = $this->getMock('Gamebook\Entity\Game',['getAvg','getGenderCode']);
		$game->method('getAvg')->willReturn(10);
	
	
		$user = $this->getMock('User',['getGenreCompatibility']);
		$user->method('getGenreCompatibility')->willReturn(10);
	
	
		$this->assertTrue($game->isRecomended($user));
	}
}